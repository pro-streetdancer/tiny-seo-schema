<?php
namespace SlimSEOPro\Schema;

class Activator {
	private $plugin = 'slim-seo-schema/slim-seo-schema.php';

	public function __construct() {
		add_filter( "plugin_action_links_{$this->plugin}", [ $this, 'add_plugin_action_links' ] );
		add_filter( 'plugin_row_meta', [ $this, 'add_plugin_meta_links' ], 10, 2 );
	}

	public function add_plugin_action_links( array $links ) : array {
		$links[] = '<a href="' . esc_url( admin_url( 'options-general.php?page=slim-seo#schema' ) ) . '">' . __( 'Settings', 'slim-seo-schema' ) . '</a>';
		return $links;
	}

	public function add_plugin_meta_links( array $meta, string $file ) {
		if ( $file !== $this->plugin ) {
			return $meta;
		}

		$meta[] = '<a href="https://docs.wpslimseo.com/slim-seo-schema/installation/" target="_blank">' . esc_html__( 'Documentation', 'slim-seo-schema' ) . '</a>';
		return $meta;
	}
}
