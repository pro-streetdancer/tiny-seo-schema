<?php
namespace SlimSEOPro\Schema\Renderer;

class Normalizer {
	private static $is_faq;

	public static function normalize( $value, bool $is_faq = false ) {
		self::$is_faq = $is_faq;
		return is_array( $value ) ? array_map( [ __CLASS__, 'normalize' ], $value ) : self::process( $value );
	}

	public static function process( $text ): string {
		global $shortcode_tags;

		$skipped_shortcodes = apply_filters( 'slim_seo_schema_skipped_shortcodes', [] );
		$shortcodes_bak     = $shortcode_tags;

		// @codingStandardsIgnoreLine.
		$shortcode_tags = array_diff_key( $shortcode_tags, array_flip( $skipped_shortcodes ) );
		$text           = do_shortcode( (string) $text );      // Parse shortcodes. Works with posts that have shortcodes in the content (using page builders like Divi).

		// @codingStandardsIgnoreLine.
		$shortcode_tags = $shortcodes_bak;            // Revert the global shortcodes registry.
		$text           = strip_shortcodes( $text );  // Strip all non-parsed shortcodes.

		// Render blocks.
		if ( function_exists( 'do_blocks' ) ) {
			$text = do_blocks( $text );
		}

		// Replace HTML tags with spaces.
		$text = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $text );
		if ( self::$is_faq ) {
			$text = preg_replace( '#<(?!\/?(h[1-6]|br|ol|ul|li|a|p|div|b|strong|i|em)(\s|>|\/))[^>]+>#i', ' ', $text );
		} else {
			$text = preg_replace( '@<[^>]*?>@s', ' ', $text );
		}

		// Remove extra white spaces.
		$text = preg_replace( '/\s+/', ' ', $text );
		$text = trim( $text );

		return $text;
	}
}
