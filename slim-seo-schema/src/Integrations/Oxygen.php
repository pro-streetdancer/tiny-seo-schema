<?php
namespace SlimSEOPro\Schema\Integrations;

use SlimSEOPro\Schema\Support\Arr;
use WP_Post;

class Oxygen {
	public function __construct() {
		add_action( 'wp_footer', [ $this, 'setup_dynamic_variables' ], 0 );
		add_filter( 'slim_seo_schema_skipped_shortcodes', [ $this, 'skip_shortcodes' ] );
	}

	public function setup_dynamic_variables() {
		if ( ! defined( 'CT_VERSION' ) ) {
			return;
		}

		add_filter( 'slim_seo_schema_data', [ $this, 'replace_post_content' ] );
	}

	public function replace_post_content( array $data ): array {
		$post = is_singular() ? get_queried_object() : get_post();
		if ( empty( $post ) ) {
			return $data;
		}
		$content = Arr::get( $data, 'post.content', '' );
		Arr::set( $data, 'post.content', $this->description( $content, $post ) );

		return $data;
	}

	public function description( $description, WP_Post $post ) {
		// In builder mode.
		if ( defined( 'SHOW_CT_BUILDER' ) ) {
			return $description;
		}

		$shortcode = get_post_meta( $post->ID, 'ct_builder_shortcodes', true );
		return $shortcode ?: $description;
	}

	public function skip_shortcodes( array $shortcodes ): array {
		$shortcodes[] = 'ct_slider';
		$shortcodes[] = 'ct_code_block';
		$shortcodes[] = 'oxy-form_widget';
		return $shortcodes;
	}
}
