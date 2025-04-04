<?php
namespace SlimSEOPro\Schema\Support;

class Data {
	private static $schemas = [];

	public static function get_schema_specs( $type ) {
		// Fix previous wrong name.
		$type = $type === 'Video' ? 'VideoObject' : $type;

		if ( empty( self::$schemas[ $type ] ) ) {
			self::$schemas[ $type ] = require_once dirname( __DIR__ ) . "/SchemaTypes/$type.php";
		}

		return self::$schemas[ $type ];
	}

	public static function get_post_types() {
		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		unset( $post_types['attachment'] );
		$post_types = array_map( function( $post_type ) {
			return [
				'slug' => $post_type->name,
				'name' => $post_type->labels->singular_name,
			];
		}, $post_types );

		return array_values( $post_types );
	}

	public static function get_taxonomies() {
		$unsupported = [
			'wp_theme',
			'wp_template_part_area',
			'link_category',
			'nav_menu',
			'post_format',
			'mb-views-category',
		];
		$taxonomies  = get_taxonomies( [], 'objects' );
		$taxonomies  = array_diff_key( $taxonomies, array_flip( $unsupported ) );
		$taxonomies  = array_map( function( $taxonomy ) {
			return [
				'slug' => $taxonomy->name,
				'name' => $taxonomy->label,
			];
		}, $taxonomies );

		return array_values( $taxonomies );
	}

	public static function plugin_warning_messages() {
		$messages = [
			// Translators: %1$s - URL to the settings page.
			'no_key'  => __( 'You have not set your Slim SEO Schema license key yet. Please <a href="%1$s" target="_blank">enter your license key</a> to continue.', 'slim-seo-schema' ),
			// Translators: %1$s - URL to the settings page.
			'invalid' => __( 'Your license key for Slim SEO Schema is <b>invalid</b>. Please <a href="%1$s" target="_blank">update your license key</a> to continue.', 'slim-seo-schema' ),
			// Translators: %1$s - URL to the settings page.
			'error'   => __( 'Your license key for Slim SEO Schema is <b>invalid</b>. Please <a href="%1$s" target="_blank">update your license key</a> to continue.', 'slim-seo-schema' ),
			// Translators: %2$s - URL to the My Account page.
			'expired' => __( 'Your license key for Slim SEO Schema is <b>expired</b>. Please <a href="%2$s" target="_blank">renew your license</a> to continue.', 'slim-seo-schema' ),
		];

		return apply_filters( 'slim_seo_schema_plugin_warning_messages', $messages );
	}
}
