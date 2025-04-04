<?php
namespace SlimSEOPro\Schema;

use SlimSEOPro\Schema\Support\Data;

class Defaults {
	public static function get(): array {
		return [
			uniqid() => self::website(),
			uniqid() => self::search_action(),
			uniqid() => self::webpage(),
			uniqid() => self::organization(),
			uniqid() => self::breadcrumbs(),
			uniqid() => self::article(),
			uniqid() => self::person(),
		];
	}

	private static function website(): array {
		return [
			'type'     => 'WebSite',
			'location' => [
				'type' => 'site',
			],
			'fields'   => self::get_schema_defaults( 'WebSite' ),
		];
	}

	private static function search_action(): array {
		return [
			'type'     => 'SearchAction',
			'location' => [
				'type' => 'site',
			],
			'fields'   => self::get_schema_defaults( 'SearchAction' ),
		];
	}

	private static function webpage(): array {
		return [
			'type'     => 'WebPage',
			'location' => [
				'type' => 'site',
			],
			'fields'   => self::get_schema_defaults( 'WebPage' ),
		];
	}

	private static function organization(): array {
		return [
			'type'     => 'Organization',
			'location' => [
				'type' => 'site',
			],
			'fields'   => self::get_schema_defaults( 'Organization' ),
		];
	}

	private static function person(): array {
		return [
			'type'     => 'Person',
			'location' => [
				'type'               => 'singular',
				'singular_locations' => [
					uniqid() => [
						uniqid() => [
							'name'  => 'post:post',
							'value' => 'all',
							'label' => __( 'All', 'slim-seo-schema' ),
						],
					],
				],
			],
			'fields'   => self::get_schema_defaults( 'Person' ),
		];
	}

	private static function breadcrumbs(): array {
		return [
			'type'     => 'BreadcrumbList',
			'location' => [
				'type' => 'site',
			],
			'fields'   => self::get_schema_defaults( 'BreadcrumbList' ),
		];
	}

	private static function article(): array {
		return [
			'type'     => 'Article',
			'location' => [
				'type'               => 'singular',
				'singular_locations' => [
					uniqid() => [
						uniqid() => [
							'name'  => 'post:post',
							'value' => 'all',
							'label' => __( 'All', 'slim-seo-schema' ),
						],
					],
				],
			],
			'fields'   => self::get_schema_defaults( 'Article' ),
		];
	}

	private static function get_schema_defaults( string $type ): array {
		$spec = Data::get_schema_specs( $type );

		return self::parse_fields( $spec );
	}

	private static function parse_fields( array $fields ): array {
		$return = [];
		foreach ( $fields as $field ) {
			if ( empty( $field['id'] ) ) {
				continue;
			}
			if ( empty( $field['required'] ) && empty( $field['show'] ) ) {
				continue;
			}
			$type = $field['type'] ?? 'Text';
			$std  = $type === 'Group' ? self::parse_group( $field ) : ( $field['std'] ?? '' );
			if ( empty( $std ) ) {
				continue;
			}
			$return[ $field['id'] ] = $std;
		}
		return $return;
	}

	private static function parse_group( array $field ): array {
		$std = self::parse_fields( $field['fields'] );
		if ( count( $std ) === 1 && isset( $std['@type'] ) ) {
			return [];
		}

		if ( empty( $std ) ) {
			return $std;
		}

		if ( ! empty( $field['cloneable'] ) ) {
			$std = [ uniqid() => $std ];
		}
		return $std;
	}
}
