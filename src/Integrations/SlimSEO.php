<?php
namespace SlimSEOPro\Schema\Integrations;

use WP_Post;

class SlimSEO {
	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init(): void {
		if ( ! defined( 'SLIM_SEO_VER' ) ) {
			return;
		}

		add_filter( 'slim_seo_schema_variables', [ $this, 'add_variables' ] );
		add_filter( 'slim_seo_schema_data', [ $this, 'add_data' ] );
	}

	public function add_variables( $variables ) {
		$variables[] = [
			'label'   => 'Slim SEO',
			'options' => [
				'slim_seo.title'          => __( 'Custom meta title', 'slim-seo-schema' ),
				'slim_seo.description'    => __( 'Custom meta description', 'slim-seo-schema' ),
				'slim_seo.facebook_image' => __( 'Custom Facebook image', 'slim-seo-schema' ),
				'slim_seo.twitter_image'  => __( 'Custom Twitter image', 'slim-seo-schema' ),
			],
		];

		return $variables;
	}

	public function add_data( array $data ): array {
		$post = is_singular() ? get_queried_object() : get_post();
		if ( ! ( $post instanceof WP_Post ) ) {
			return $data;
		}

		$slim_seo = get_post_meta( $post->ID, 'slim_seo', true );

		return empty( $slim_seo ) ? $data : array_merge( $data, [ 'slim_seo' => $slim_seo ] );
	}
}
