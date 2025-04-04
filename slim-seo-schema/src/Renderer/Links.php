<?php
namespace SlimSEOPro\Schema\Renderer;

use SlimSEOPro\Schema\Settings;

class Links {
	private $input;
	private $schemas;
	private $active = [];
	private $ids    = [];

	/**
	 * @param array $input Associative array of schemas, used to check and render on the frontend.
	 */
	public function __construct( array $input ) {
		$this->input   = $input;
		$this->schemas = Settings::get_schemas();

		array_walk( $this->input, [ PropParser::class, 'parse' ] );
		array_walk( $this->schemas, [ PropParser::class, 'parse' ] );

		$this->active = $this->input;
	}

	public function get_active(): array {
		foreach ( $this->input as $schema ) {
			$this->ids[]  = PropParser::get_id( $schema );
			$linked       = $this->get_linked_schemas( $schema );
			$this->active = array_merge( $this->active, $linked );
		}

		return $this->active;
	}

	private function get_linked_schemas( array $schema ): array {
		$ids    = $this->get_linked_ids( $schema );
		$linked = [];
		foreach ( $ids as $id ) {
			$this->ids[]   = $id;
			$linked_schema = $this->get_schema( $id );
			if ( empty( $linked_schema ) || $this->is_included( $linked_schema ) ) {
				continue;
			}

			$linked[] = $linked_schema;

			// Recursively get linked schemas.
			$linked = array_merge( $linked, $this->get_linked_schemas( $linked_schema ) );
		}

		return $linked;
	}

	private function get_linked_ids( array $schema ): array {
		$ids = [];
		array_walk_recursive( $schema['fields'], function ( $field ) use ( &$ids ) {
			if ( is_string( $field ) && strpos( $field, '{{ schemas.' ) === 0 ) {
				$ids[] = substr( $field, 11, -3 );
			}
		} );
		return array_diff( $ids, $this->ids );
	}

	private function get_schema( string $id ): array {
		foreach ( $this->schemas as $schema ) {
			if ( PropParser::get_id( $schema ) === $id ) {
				return $schema;
			}
		}
		return [];
	}

	private function is_included( array $schema ): bool {
		foreach ( $this->active as $active ) {
			if ( $active === $schema ) {
				return true;
			}
		}
		return false;
	}
}
