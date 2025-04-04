<?php
namespace SlimSEOPro\Schema\Api;

use SlimSEOPro\Schema\Settings;
use WP_REST_Request;
use WP_REST_Server;

class Schemas extends Base {
	public function register_routes() {
		register_rest_route( 'slim-seo-schema', 'schemas', [
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => [ Settings::class, 'get_schemas' ],
			'permission_callback' => [ $this, 'has_permission' ],
		] );

		register_rest_route( 'slim-seo-schema', 'schemas', [
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => [ $this, 'save' ],
			'permission_callback' => [ $this, 'has_permission' ],
		] );
	}

	public function save( WP_REST_Request $request ): bool {
		$data = $request->get_param( 'schemas' );
		return update_option( Settings::OPTION_NAME, $data );
	}
}
