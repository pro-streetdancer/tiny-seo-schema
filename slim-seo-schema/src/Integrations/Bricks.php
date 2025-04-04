<?php
namespace SlimSEOPro\Schema\Integrations;

use SlimSEOPro\Schema\Support\Arr;
use WP_Post;

class Bricks {
	public function __construct() {
		add_action( 'wp_footer', [ $this, 'setup_dynamic_variables' ], 0 );
	}

	public function setup_dynamic_variables() {
		if ( ! defined( 'BRICKS_VERSION' ) ) {
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

		// Priority WordPress post content first.
		if ( $content ) {
			return $data;
		}

		Arr::set( $data, 'post.content', $this->description( $content, $post ) );

		return $data;
	}

	public function description( $description, WP_Post $post ): string {
		// Get from the post first, then from the template.
		$data = get_post_meta( $post->ID, BRICKS_DB_PAGE_CONTENT, true );
		if ( empty( $data ) ) {
			$data = \Bricks\Helpers::get_bricks_data( $post->ID );
		}
		if ( empty( $data ) ) {
			return $description;
		}

		$data        = $this->remove_elements( $data );
		$description = \Bricks\Frontend::render_data( $data );

		return (string) $description;
	}

	private function remove_elements( array $data ): array {
		// Skip these elements as their content are not suitable for meta description.
		$skipped_elements = apply_filters( 'slim_seo_bricks_skipped_elements', [
			// Bricks.
			'audio',
			'code',
			'divider',
			'facebook-page',
			'form',
			'icon',
			'map',
			'nav-menu',
			'pagination',
			'pie-chart',
			'post-author',
			'post-comments',
			'post-meta',
			'post-navigation',
			'post-taxonomy',
			'post-sharing',
			'post-title',
			'posts',
			'related-posts',
			'search',
			'sidebar',
			'social-icons',
			'svg',
			'video',
			'wordpress',

			// WP Grid Builder.
			'wpgb-facet',
		] );

		return array_filter( $data, function( $element ) use ( $skipped_elements ) {
			if ( in_array( $element['name'], $skipped_elements, true ) ) {
				return false;
			}

			// Ignore element with query loop.
			if ( ! empty( $element['settings']['hasLoop'] ) ) {
				return false;
			}

			return true;
		} );
	}
}
