<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

class Yoast extends Base {
	use MergeSchemasTrait;

	public function setup() {
		add_filter( 'wpseo_schema_graph', [ $this, 'merge_schemas' ] );
	}
}
