<?php
namespace SlimSEOPro\Schema\Integrations;

use SlimSEOPro\Schema\Support\Arr;
use WP_Post;

class ZionBuilder {
	public function __construct() {
		add_action( 'wp_footer', [ $this, 'setup_dynamic_variables' ], 0 );
	}

	public function setup_dynamic_variables() {
		if ( ! class_exists( '\ZionBuilder\Plugin' ) ) {
			return;
		}

		add_filter( 'slim_seo_schema_data', [ $this, 'replace_post_content' ] );
	}

	public function replace_post_content( $data ) {
		$post = is_singular() ? get_queried_object() : get_post();
		if ( empty( $post ) ) {
			return $data;
		}
		$content = Arr::get( $data, 'post.content', '' );
		Arr::set( $data, 'post.content', $this->description( $content, $post ) );

		return $data;
	}

	public function description( $description, WP_Post $post ) {
		$post_instance = \ZionBuilder\Plugin::$instance->post_manager->get_post_instance( $post->ID );

		if ( ! $post_instance || $post_instance->is_password_protected() || ! $post_instance->is_built_with_zion() ) {
			return $description;
		}

		$post_template_data = $post_instance->get_template_data();
		if ( empty( $post_template_data ) ) {
			return $description;
		}

		$content = $this->get_content( $post_template_data );

		return $content;
	}

	private function get_content( $data ) {
		$content = array_map( [ $this, 'get_element_content' ], $data );
		return implode( ' ', $content );
	}

	private function get_element_content( $element ) {
		$content = empty( $element['content'] ) ? '' : $element['content'];

		if ( is_array( $content ) ) {
			$content = $this->get_content( $content );
		}

		if ( ! empty( $element['options'] ) ) {
			$content .= ' ' . $this->get_element_content( $element['options'] );
		}

		return $content;
	}
}
