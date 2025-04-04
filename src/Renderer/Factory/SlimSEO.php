<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

class SlimSEO extends Base {
	use MergeSchemasTrait;

	public function setup() {
		add_filter( 'slim_seo_schema_graph', [ $this, 'merge_schemas' ] );
	}

	public function is_schema_enabled(): bool {
	    $options = get_option( 'slim_seo' );
	    return empty( $options['features'] ) || in_array( 'schema', $options['features'], true );
	}
}
