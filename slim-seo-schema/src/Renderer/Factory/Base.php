<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

use SlimSEOPro\Schema\Location\Validator;
use SlimSEOPro\Schema\Renderer\Links;
use SlimSEOPro\Schema\Renderer\SchemaRenderer;
use SlimSEOPro\Schema\Renderer\VariableRenderer;
use SlimSEOPro\Schema\Settings;

abstract class Base {
	private $variable_renderer;

	public function __construct( VariableRenderer $variable_renderer ) {
		$this->variable_renderer = $variable_renderer;
	}

	abstract public function setup();

	public function get_graph(): array {
		$schemas = $this->get_schemas();
		if ( ! $schemas ) {
			return [];
		}

		$schemas = $this->render( $schemas );

		return apply_filters( 'slim_seo_schema_all', $schemas );
	}

	private function get_schemas() {
		$schemas = [];
		if ( is_singular() ) {
			$schemas = $this->get_from_post();
		}
		if ( empty( $schemas ) ) {
			$schemas = $this->get_from_settings();
		}

		$links = new Links( $schemas );
		return $links->get_active();
	}

	private function get_from_post() {
		$schema = get_post_meta( get_the_ID(), 'slim_seo_schema', true );
		return empty( $schema ) ? [] : [ $schema ];
	}

	private function get_from_settings() {
		$schemas = Settings::get_schemas();
		return array_filter( $schemas, [ $this, 'validate' ] );
	}

	private function render( array $schemas ): array {
		$rendered = [];

		foreach ( $schemas as $schema ) {
			$renderer   = new SchemaRenderer( $schema['type'], $schema['fields'], $this->variable_renderer );
			$rendered[] = $renderer->render();
		}

		return array_filter( $rendered );
	}

	private function validate( $schema ) {
		if ( empty( $schema['location'] ) ) {
			return false;
		}

		$validator = new Validator( $schema['location'] );
		$exclude   = new Validator( $schema['exclude'] ?? [] );
		return $validator->validate() && ! $exclude->validate();
	}
}
