<?php
namespace SlimSEOPro\Schema\Location;

class Settings {

	public function get_localized_data() {
		$archive_rules  = [];
		$singular_rules = [];

		return apply_filters( 'slim_seo_schema_locations', [
			'locationTypes'     => $this->get_location_types(),
			'singularLocations' => $this->get_singular_locations(),
			'archiveLocations'  => $this->get_archive_locations(),
			'singularRules'     => $singular_rules,
			'archiveRules'      => $archive_rules,
			'text'              => [
				'addGroup' => __( 'Add Rule Group', 'slim-seo-schema' ),
				'and'      => __( 'And', 'slim-seo-schema' ),
				'or'       => __( 'Or', 'slim-seo-schema' ),
				'select'   => __( 'Select', 'slim-seo-schema' ),
				'all'      => __( 'All', 'slim-seo-schema' ),
			],
		] );
	}

	public function get_location_types() {
		return [
			[
				'label' => __( 'Entire site', 'slim-seo-schema' ),
				'value' => 'site',
			],
			[
				'label' => __( 'Singular', 'slim-seo-schema' ),
				'value' => 'singular',
			],
			[
				'label' => __( 'Archive', 'slim-seo-schema' ),
				'value' => 'archive',
			],
			[
				'label' => __( 'Code', 'slim-seo-schema' ),
				'value' => 'code',
			],
		];
	}

	public static function get_singular_locations() {
		$locations = [
			'general' => [
				'label'   => __( 'General', 'slim-seo-schema' ),
				'options' => [
					[
						'value' => 'general:all',
						'label' => __( 'All Singular', 'slim-seo-schema' ),
					],
				],
			],
		];

		$unsupported = [
			// Page builders.
			'elementor_library',
			'fl-builder-template',
		];

		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		$post_types = array_diff_key( $post_types, array_flip( $unsupported ) );
		foreach ( $post_types as $slug => $post_type ) {
			$post_group = [
				'label'   => $post_type->labels->singular_name,
				'options' => [
					[
						'value' => "$slug:post",
						'label' => $post_type->labels->singular_name,
					],
				],
			];

			$options = &$post_group['options'];

			// Taxonomies.
			$taxonomies = get_object_taxonomies( $slug, 'objects' );
			foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {
				$public = $taxonomy->public && $taxonomy->show_ui;
				if ( 'post_format' === $taxonomy_slug || ! $public ) {
					continue;
				}
				$options[] = [
					'value' => "$slug:$taxonomy_slug",
					'label' => $taxonomy->labels->singular_name,
				];
			}

			$locations[ $slug ] = $post_group;
		}

		return $locations;
	}

	public static function get_archive_locations() {
		$locations = [
			[
				'label'   => __( 'General', 'slim-seo-schema' ),
				'options' => [
					[
						'value' => 'general:all',
						'label' => __( 'All Archives', 'slim-seo-schema' ),
					],
					[
						'value' => 'general:author',
						'label' => __( 'Author Archives', 'slim-seo-schema' ),
					],
					[
						'value' => 'general:date',
						'label' => __( 'Date Archives', 'slim-seo-schema' ),
					],
					[
						'value' => 'general:search',
						'label' => __( 'Search Results', 'slim-seo-schema' ),
					],
				],
			],
		];

		$unsupported = [
			// WordPress built-in post types.
			'page',
			'attachment',

			// Page builders.
			'elementor_library',
			'fl-builder-template',
		];
		$post_types  = get_post_types( [ 'public' => true ], 'objects' );
		$post_types  = array_diff_key( $post_types, array_flip( $unsupported ) );
		foreach ( $post_types as $slug => $post_type ) {
			$post_group = [
				'label'   => $post_type->labels->singular_name,
				'options' => [],
			];

			$options = &$post_group['options'];

			// Post type archive.
			if ( 'post' === $slug || $post_type->has_archive ) {
				$options[] = [
					'value' => "$slug:archive",
					// Translators: %s - post type singular label.
					'label' => sprintf( __( '%s Archive', 'slim-seo-schema' ), $post_type->labels->singular_name ),
				];
			}

			// Taxonomies archives.
			$taxonomies = get_object_taxonomies( $slug, 'objects' );
			foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {
				$public = $taxonomy->public && $taxonomy->show_ui;
				if ( 'post_format' === $taxonomy_slug || ! $public ) {
					continue;
				}
				$options[] = [
					'value' => "$slug:$taxonomy_slug",
					// Translators: %s - post type singular label.
					'label' => sprintf( __( '%s Archive', 'slim-seo-schema' ), $taxonomy->labels->singular_name ),
				];
			}

			$locations[] = $post_group;
		}

		return $locations;
	}
}
