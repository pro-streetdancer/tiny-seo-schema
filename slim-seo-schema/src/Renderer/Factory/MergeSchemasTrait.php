<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

use SlimSEOPro\Schema\Support\Arr;

trait MergeSchemasTrait {
	private $data = [];

	public function merge_schemas( array $data ): array {
		$graph = $this->get_graph();
		if ( empty( $graph ) ) {
			return $data;
		}

		$this->data = array_values( $data );

		foreach ( $this->data as &$schema ) {
			$type = is_array( $schema['@type'] ) ? $schema['@type'][ array_key_last( $schema['@type'] ) ] : $schema['@type'];
			$index = $this->find_index( $graph, $type );

			if ( $index === -1 ) {
				continue;
			}

			$schema = Arr::merge_recursive( $schema, $graph[ $index ] );

			unset( $graph[ $index ] );
		}

		return array_values( array_merge( $this->data, $graph ) );
	}

	private function find_index( array $schemas, string $type ): int {
		$types = wp_list_pluck( $schemas, '@type' );
		$index = array_search( $type, $types );
		return $index === false ? -1 : $index;
	}
}
