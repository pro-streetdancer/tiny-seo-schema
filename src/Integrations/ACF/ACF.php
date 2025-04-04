<?php
namespace SlimSEOPro\Schema\Integrations\ACF;

class ACF {
	private $variables;

	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init(): void {
		if ( ! class_exists( 'ACF' ) ) {
			return;
		}

		add_filter( 'slim_seo_schema_variables', [ $this, 'add_variables' ] );
		add_filter( 'slim_seo_schema_data', [ $this, 'add_data' ] );
	}

	public function add_variables( array $variables ): array {
		$this->variables = $variables;

		$field_groups = acf_get_field_groups();
		array_walk( $field_groups, [ $this, 'add_group' ] );

		return $this->variables;
	}

	public function add_data( array $data ): array {
		$post = is_singular() ? get_queried_object() : get_post();

		if ( empty( $post ) ) {
			return [];
		}

		$field_objects = get_field_objects( $post->ID ) ?: [];

		// Option fields.
		if ( function_exists( 'acf_add_options_page' ) ) {
			$option_field_objects = get_field_objects( 'option' );

			if ( ! empty( $option_field_objects ) ) {
				$field_objects = array_merge( $option_field_objects, $field_objects );
			}
		}

		// Post author fields.
		$author_field_objects = get_field_objects( 'user_' . $post->post_author );

		if ( ! empty( $author_field_objects ) ) {
			$field_objects = array_merge( $author_field_objects, $field_objects );
		}

		if ( ! empty( $field_objects ) ) {
			$data['acf'] = new Renderer( $field_objects );
		}

		return $data;
	}

	private function add_group( array $field_group ): void {
		$this->variables[] = [
			// Translators: %s - field group title.
			'label'   => sprintf( __( '[ACF] %s', 'slim-seo-schema' ), $field_group['title'] ),
			'options' => $this->add_fields( acf_get_fields( $field_group['key'] ), 'acf' ),
		];
	}

	private function add_fields( array $fields, string $base_id = '', string $indent = '' ): array {
		$options    = [];
		$fields     = array_filter( $fields, [ $this, 'has_value' ] );
		$sub_indent = $indent . str_repeat( '&nbsp;', 5 );

		foreach ( $fields as $field ) {
			$field_name     = $field['name'];
			$id             = "$base_id.{$field_name}";
			$label          = "{$indent}{$field['label']}";

			if ( 'google_map' === $field['type'] ) {
				$options[ $id . '.address' ]  = sprintf( __( '%s (address)', 'slim-seo-schema' ), $label );
				$options[ $id . '.lat' ]      = sprintf( __( '%s (latitude)', 'slim-seo-schema' ), $label );
				$options[ $id . '.lng' ]      = sprintf( __( '%s (longitude)', 'slim-seo-schema' ), $label );
				$options[ $id . '.name' ]     = sprintf( __( '%s (name)', 'slim-seo-schema' ), $label );
				$options[ $id . '.city' ]     = sprintf( __( '%s (city)', 'slim-seo-schema' ), $label );
				$options[ $id . '.state' ]    = sprintf( __( '%s (state)', 'slim-seo-schema' ), $label );
				$options[ $id . '.country' ]  = sprintf( __( '%s (country)', 'slim-seo-schema' ), $label );
				$options[ $id . '.country_short' ] = sprintf( __( '%s (country short name)', 'slim-seo-schema' ), $label );
			} else {
				$options[ $id ] = $label;
			}

			if ( ! empty( $field['sub_fields'] ) ) {
				$options = array_merge( $options, $this->add_fields( $field['sub_fields'], $id, $sub_indent ) );
			}

			if ( ! empty( $field['layouts'] ) ) {
				$options = array_merge( $options, $this->add_fields( $field['layouts'], $id, $sub_indent ) );
			}
		}
		return $options;
	}

	private function has_value( array $field ): bool {
		return ! in_array( $field['type'] ?? '', [ 'message', 'accordion', 'tab' ], true );
	}
}
