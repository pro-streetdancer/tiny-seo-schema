<?php
namespace SlimSEOPro\Schema\Api;

use WP_REST_Server;
use WP_REST_Request;

class Location extends Base {
	public function register_routes() {
		$params = [
			'method'              => WP_REST_Server::READABLE,
			'permission_callback' => [ $this, 'has_permission' ],
			'args'                => [
				'name'     => [
					'sanitize_callback' => 'sanitize_text_field',
				],
				'term'     => [
					'sanitize_callback' => 'sanitize_text_field',
				],
				'selected' => [
					'sanitize_callback' => 'sanitize_text_field',
				],
			],
		];
		register_rest_route( 'slim-seo-schema', 'terms', array_merge( $params, [
			'callback' => [ $this, 'get_terms' ],
		] ) );
		register_rest_route( 'slim-seo-schema', 'posts', array_merge( $params, [
			'callback' => [ $this, 'get_posts' ],
		] ) );
	}

	public function get_terms( WP_REST_Request $request ) {
		$search_term        = $request->get_param( 'term' );
		$name               = $request->get_param( 'name' );
		list( , $taxonomy ) = explode( ':', $name );

		$field = [
			'query_args' => [
				'taxonomy'   => $taxonomy,
				'name__like' => $search_term,
				'orderby'    => 'name',
				'number'     => 10,
			],
		];
		$data  = $this->query_terms( null, $field );
		$data  = array_values( $data );

		return apply_filters( 'slim_seo_schema_location_terms', $data, $request );
	}

	public function get_posts( WP_REST_Request $request ): array {
		$search_term       = $request->get_param( 'term' );
		$name              = $request->get_param( 'name' );
		list( $post_type ) = explode( ':', $name );

		global $wpdb;
		$sql   = "SELECT ID, post_title FROM $wpdb->posts WHERE post_type=%s AND post_title LIKE '%%" . esc_sql( $search_term ) . "%%' ORDER BY post_title ASC LIMIT 10";
		$sql   = $wpdb->prepare( $sql, $post_type );

		$posts = $wpdb->get_results( $sql );

		$options = [];
		foreach ( $posts as $post ) {
			$options[] = [
				'value' => $post->ID,
				'label' => $post->post_title,
			];
		}

		return $options;
	}

	/**
	 * Query terms for field options.
	 *
	 * @param  array $meta  Saved meta value.
	 * @param  array $field Field settings.
	 * @return array        Field options array.
	 */
	private function query_terms( $meta, $field ) {
		$args = wp_parse_args(
			$field['query_args'],
			array(
				'hide_empty'             => false,
				'count'                  => false,
				'update_term_meta_cache' => false,
			)
		);

		// Query only selected items.
		if ( ! empty( $field['ajax'] ) && ! empty( $meta ) ) {
			$args['include'] = $meta;
		}

		$terms = get_terms( $args );
		if ( ! is_array( $terms ) ) {
			return array();
		}
		$options = array();
		foreach ( $terms as $term ) {
			$label                     = $term->name ? $term->name : __( '(No title)', 'meta-box' );
			$options[ $term->term_id ] = array(
				'value'  => $term->term_id,
				'label'  => $label,
				'parent' => $term->parent,
			);
		}
		return $options;
	}
}
