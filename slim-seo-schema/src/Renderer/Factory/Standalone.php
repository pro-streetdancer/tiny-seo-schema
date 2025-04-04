<?php
namespace SlimSEOPro\Schema\Renderer\Factory;

class Standalone extends Base {
	public function setup() {
		add_action( 'wp_footer', [ $this, 'output' ] );
	}

	public function output() {
		$graph = $this->get_graph();
		if ( empty( $graph ) ) {
			return;
		}

		$schema = [
			'@context' => 'https://schema.org',
			'@graph'   => array_values( $graph ),
		];
		$flags  = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
		if ( wp_get_environment_type() !== 'production' ) {
			$flags = $flags | JSON_PRETTY_PRINT;
		}
		echo '<script type="application/ld+json" id="slim-seo-schema">', wp_json_encode( $schema, $flags ), '</script>';
	}
}
