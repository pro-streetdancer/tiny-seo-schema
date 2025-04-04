<?php
namespace SlimSEOPro\Schema\Renderer;

use SlimSEOPro\Schema\Support\Arr;

class PropParser {
	const DEFAULT_ID = '{{ current.url }}#{{ id }}';

	public static function parse( &$schema ) {
		$type   = $schema['type'];
		$fields = &$schema['fields'];

		$fields['@id'] = self::get_id_value( $schema );

		$custom_fields = $fields['custom'] ?? [];
		$custom_fields = self::parse_custom_fields( $custom_fields );
		unset( $fields['custom'] );

		$fields = Arr::undot( $custom_fields, array_merge( [ '@type' => $type ], $fields ) );
	}

	public static function parse_custom_fields( $custom_fields ) {
		if ( empty( $custom_fields ) ) {
			return [];
		}
		$fields = [];
		foreach ( $custom_fields as $field ) {
			$fields[ $field['key'] ] = $field['value'];
		}
		return $fields;
	}

	public static function get_id( array $schema ): string {
		$label = Arr::get( $schema, 'fields._label', $schema['type'] );
		return self::sanitize_id( $label );
	}

	public static function get_id_value( array $schema ): string {
		// Always use custom ID if it exists.
		$custom_id = self::get_custom_schema_id( $schema );
		if ( $custom_id ) {
			return $custom_id;
		}

		if ( Arr::get( $schema, 'type' ) === 'Person' ) {
			return self::get_person_schema_id( $schema );
		}
		$id = Arr::get( $schema, 'fields.@id', self::DEFAULT_ID );
		return str_replace( '{{ id }}', self::get_id( $schema ), $id );
	}

	/**
	 * Sanitize id for connecting schemas together.
	 *
	 * @see JavaScript's sanitizeId() function in PropInserter.js.
	 */
	private static function sanitize_id( string $text ): string {
		$id = sanitize_title( $text );
		$id = preg_replace( '/[^a-z0-9_]/', '_', $id ); // Only accepts alphanumeric and underscores.
		$id = preg_replace( '/[ _]{2,}/', '_', $id );   // Remove duplicated `_`.
		$id = trim( $id, '_' );                         // Trim `_`.
		$id = preg_replace( '/^\d+/', '', $id );        // Don't start with numbers.
		$id = trim( $id, '_' );                         // Trim `_` again.

		return $id;
	}

	private static function get_person_schema_id( array $schema ): string {
		$user = null;
		foreach ( $schema['fields'] as $field ) {
			if ( is_string( $field ) && str_contains( $field, 'author.' ) ) {
				$user = get_userdata( get_the_author_meta( 'ID' ) );
				break;
			}
			if ( is_string( $field ) && str_contains( $field, 'user.' ) ) {
				$user = wp_get_current_user();
				break;
			}
		}
		if ( ! $user ) {
			return self::DEFAULT_ID;
		}

		return home_url( '/#/schema/person/' . md5( $user->user_login ) );
	}

	/**
	 * Get custom @id from custom fields.
	 * Need to manually parse custom fields because they are used to get the data before parsing schemas.
	 */
	private static function get_custom_schema_id( array $schema ): string {
		if ( empty( $schema['fields']['custom'] ) || ! is_array( $schema['fields']['custom'] ) ) {
			return '';
		}
		foreach ( $schema['fields']['custom'] as $custom ) {
			if ( $custom['key'] === '@id' ) {
				return $custom['value'];
			}
		}

		return '';
	}
}
