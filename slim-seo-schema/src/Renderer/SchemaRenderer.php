<?php
namespace SlimSEOPro\Schema\Renderer;

use SlimSEOPro\Schema\Support\Arr;
use SlimSEOPro\Schema\Support\Data;

class SchemaRenderer {
	private $type;
	private $props;
	private $schema;
	private $variable_renderer;

	public function __construct( string $type, array $props, VariableRenderer $variable_renderer ) {
		unset( $props['_label'] );

		$this->type              = $type;
		$this->props             = $props;
		$this->variable_renderer = $variable_renderer;

		$this->parse_custom_json_ld();

		$this->schema = $this->type === 'CustomJsonLd' ? [] : [
			'fields' => Data::get_schema_specs( $this->type ),
		];
	}

	private function parse_custom_json_ld(): void {
		if ( $this->type !== 'CustomJsonLd' || empty( $this->props['code'] ) ) {
			return;
		}

		// Extract the JSON code incase users enter with <script type="application/ld+json">...</script>
		$code       = $this->props['code'];
		$json_start = strpos( $code, '{' );
		$json_end   = strrpos( $code, '}' );
		$json       = substr( $code, $json_start, $json_end - $json_start + 1 );
		$fields     = json_decode( $json, true ) ?: [];

		// If user entered full schema graph, just take the schemas only.
		if ( isset( $fields['@graph'] ) ) {
			$fields = $fields['@graph'];
		}

		$this->props = $fields;
	}

	public function render(): array {
		$this->props = apply_filters( 'slim_seo_schema_props', $this->props );
		$this->render_props( $this->props );
		return Cleaner::cleanup( $this->props );
	}

	/**
	 * Render array of props.
	 *
	 * @param array  $props  Array of schema props.
	 * @param string $prefix Key prefix, to access the prop settings from the specs.
	 */
	private function render_props( &$props, $prefix = '' ) {
		if ( empty( $props ) ) {
			return;
		}

		foreach ( $props as $key => &$value ) {
			$key = trim( "$prefix.$key", '.' );

			if ( is_array( $value ) ) {
				$this->render_array_prop( $value, $key );
			} elseif( isset( $props['@type'] ) && 'FAQPage' === $props['@type'] ) {
				$this->variable_renderer->render( $value, true );
			} else {
				$this->variable_renderer->render( $value );
			}
		}

		$props = array_filter( $props );
		if ( Arr::is_numeric_key( $props ) ) {
			$props = array_values( $props );
		}
	}

	private function render_array_prop( &$value, $key ) {
		$settings = Arr::find_sub_field( $this->schema, $key );

		// Non-cloneable props, e.g. normal group: render sub-props.
		if ( ! Arr::get( $settings, 'cloneable' ) ) {
			$this->render_props( $value, $key );
			return;
		}

		// Stack cloneable props.
		CloneableProps::increase();

		// Remove keys.
		$value = array_values( $value );

		// Non-group props, like image: render and merge all values.
		if ( Arr::get( $settings, 'type' ) !== 'Group' ) {
			array_walk( $value, [ $this->variable_renderer, 'render' ] );

			$value = Arr::flatten( $value );
			CloneableProps::decrease();
			return;
		}

		// Simply render each clone if it has sub cloneable groups.
		if ( $this->has_cloneable_group( $settings ) ) {
			foreach ( $value as &$clone ) {
				$this->render_props( $clone, $key );
			}
			CloneableProps::decrease();
			return;
		}

		// No sub cloneable group: re-parse value.
		$this->render_cloneable_group_without_sub_cloneable_group( $value );

		CloneableProps::decrease();
	}

	private function render_cloneable_group_without_sub_cloneable_group( array &$value ): void {
		$new_value = [];
		foreach ( $value as &$clone ) {
			$clone = Arr::dot( $clone );
			array_walk( $clone, [ $this->variable_renderer, 'render' ] );

			$count = $this->count_clones( $clone );
			for ( $i = 1; $i <= $count; $i++ ) {
				$new_clone   = $this->build_clone( $clone, $i );
				$new_value[] = Arr::undot( $new_clone );
			}
		}
		$value = $new_value;
	}

	/**
	 * Build new clone from a clone with multiple values in some props.
	 */
	private function build_clone( array $clone, int $index ): array {
		--$index;
		$return = [];
		foreach ( $clone as $key => $value ) {
			$return[ $key ] = is_array( $value ) ? ( isset( $value[ $index ] ) ? $value[ $index ] : null ) : $value;
		}
		return $return;
	}

	/**
	 * Count how many (max) values (Meta Box clone values) in every prop of a group.
	 */
	private function count_clones( array $value ): int {
		$count = 1;
		foreach ( $value as $sub_value ) {
			if ( is_array( $sub_value ) && count( $sub_value ) > $count ) {
				$count = count( $sub_value );
			}
		}
		return $count;
	}

	/**
	 * Check if a group has a sub cloneable group.
	 */
	private function has_cloneable_group( array $prop ): string {
		foreach ( $prop['fields'] as $sub_prop ) {
			if ( Arr::get( $sub_prop, 'type' ) !== 'Group' ) {
				continue;
			}

			// If current field (group) is cloneable or has a cloneable child.
			if ( ! empty( $sub_prop['cloneable'] ) || $this->has_cloneable_group( $sub_prop ) ) {
				return true;
			}
		}

		return false;
	}
}
