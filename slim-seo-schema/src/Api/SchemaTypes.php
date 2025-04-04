<?php
namespace SlimSEOPro\Schema\Api;

use SlimSEOPro\Schema\Support\Data;
use WP_REST_Server;
use WP_REST_Request;

class SchemaTypes extends Base {
	public function register_routes() {
		register_rest_route( 'slim-seo-schema', 'types', [
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => [ $this, 'get_schema_type' ],
			'permission_callback' => [ $this, 'has_permission' ],
			'args'                => [
				'type' => [
					'sanitize_callback' => 'sanitize_text_field',
				],
			],
		] );
	}

	public function get_schema_type( WP_REST_Request $request ) {
		$type    = $request->get_param( 'type' );
		$specs   = Data::get_schema_specs( $type );
		$specs[] = [
			'label'   => __( 'Custom', 'slim-seo-schema' ),
			'id'      => 'custom',
			'type'    => 'Custom',
			'tooltip' => __( 'Custom properties for the schema.', 'slim-seo-schema' ),
		];
		return $specs;
	}

}
