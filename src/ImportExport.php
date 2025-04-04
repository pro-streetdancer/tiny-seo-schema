<?php
namespace SlimSEOPro\Schema;

class ImportExport {
	public function __construct() {
		add_action( 'load-settings_page_slim-seo', [ $this, 'add_tools_tab' ] );
		add_action( 'load-settings_page_slim-seo', [ $this, 'export' ] );
		add_action( 'slim_seo_tools_tab_content', [ $this, 'add_content_to_tools_tab' ] );

		add_action( 'admin_print_styles-settings_page_slim-seo', [ $this, 'enqueue' ] );
	}

	public function add_tools_tab() {
		if ( ! $this->slim_seo_active() ) {
			add_filter( 'slim_seo_settings_tabs', [ $this, 'add_tab' ] );
			add_filter( 'slim_seo_settings_panes', [ $this, 'add_pane' ] );
		}
	}

	public function add_tab( $tabs ) {
		$tabs['tools'] = __( 'Tools', 'slim-seo-schema' );
		return $tabs;
	}

	public function add_pane( $panes ) {
		$panes['tools'] = '<div id="tools" class="ss-tab-pane"><div id="ssschema-import-export"></div></div>';
		return $panes;
	}

	public function add_content_to_tools_tab() {
		if ( $this->slim_seo_active() ) {
			echo '<div id="ssschema-import-export"></div>';
		}
	}

	public function export() {
		$action = $_GET['action'] ?? '';
		if ( $action !== 'export' ) {
			return;
		}

		check_ajax_referer( 'export' );

		$schema    = Settings::get_schemas();
		$data      = wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
		$file_name = 'slimseo_schemas_' . gmdate( 'Y-m-d' ) . '.json';

		header( 'Content-Type: application/octet-stream' );
		header( "Content-Disposition: attachment; filename=$file_name" );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . strlen( $data ) );
		echo $data;
		die;
	}

	public function enqueue() {
		wp_enqueue_script( 'slim-seo-schema-import-export', SLIM_SEO_SCHEMA_URL . 'js/import-export.js', [ 'wp-element', 'wp-i18n' ], filemtime( SLIM_SEO_SCHEMA_DIR . '/js/import-export.js' ), true );
		wp_localize_script( 'slim-seo-schema-import-export', 'SSSchemaIE', [
			'exportUrl' => wp_nonce_url( add_query_arg( 'action', 'export', admin_url( 'options-general.php?page=slim-seo' ) ), 'export' ),
		] );
	}

	private function slim_seo_active() {
		return is_plugin_active( 'slim-seo/slim-seo.php' );
	}
}
