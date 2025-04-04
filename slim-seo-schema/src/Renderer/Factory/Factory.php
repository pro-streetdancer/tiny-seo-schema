<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

use SlimSEOPro\Schema\Renderer\VariableRenderer;

class Factory {
	public static function make( VariableRenderer $variable_renderer ): Base {
		/**
		 * When users disable Yoast's schema output, then use the standalone mode.
		 * Otherwise, merge the schemas into Yoast's schemas.
		 * @see Yoast\WP\SEO\Presenters\Schema_Presenter
		 */
		if ( defined( 'WPSEO_FILE' ) && self::is_yoast_schema_enabled() ) {
			return new Yoast( $variable_renderer );
		}

		if ( defined( 'SLIM_SEO_VER' ) ) {
			$slim_seo = new SlimSEO( $variable_renderer );
			if ( $slim_seo->is_schema_enabled() ) {
				return $slim_seo;
			}
		}

		return new Standalone( $variable_renderer );
	}

	private static function is_yoast_schema_enabled(): bool {
		$deprecated_data = [
			'_deprecated' => 'Please use the "wpseo_schema_*" filters to extend the Yoast SEO schema data - see the WPSEO_Schema class.',
		];
		$return = apply_filters( 'wpseo_json_ld_output', $deprecated_data, '' );
		return $return !== [] && $return !== false;
	}
}
