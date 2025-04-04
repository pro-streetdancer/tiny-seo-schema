<?php
namespace SlimSEOPro\Schema;

use SlimSEO\Settings\Page;
use SlimSEO\Updater\Tab;
use eLightUp\PluginUpdater\Manager;
use SlimSEO\Updater\Settings as UpdaterSettings;

new Activator;
new Api\Schemas;
new Api\SchemaTypes;
new Api\Data;
new Api\MetaKeys;
new Api\Location;
new Api\Import;
new Integrations\MetaBox\MetaBox;
new Integrations\ACF\ACF;
new Integrations\WooCommerce;
new Integrations\SlimSEO;

// Initialize WPML integration
$wpml = new Integrations\WPML;
if ( $wpml->is_active() ) {
	$wpml->setup();
}

// Initialize Polylang integration
$polylang = new Integrations\Polylang;
if ( $polylang->is_active() ) {
	$polylang->setup();
}

$manager_args      = apply_filters( 'slim_seo_schema_manager_args', [
	'api_url'            => 'https://wpslimseo.com/index.php',
	'my_account_url'     => 'https://wpslimseo.com/my-account/',
	'buy_url'            => 'https://wpslimseo.com/products/slim-seo-schema/',
	'slug'               => 'slim-seo-schema',
	'settings_page'      => admin_url( 'options-general.php?page=slim-seo#license' ),
	'settings_page_slug' => 'slim-seo',
] );
$manager           = new Manager( $manager_args );
$settings          = new UpdaterSettings( $manager, $manager->checker, $manager->option );
$manager->settings = $settings;
$manager->setup();

if ( is_admin() ) {
	Page::setup();
	new ImportExport;

	Tab::setup();

	new Settings( $manager );
	new Post( $manager );
} else {
	$status = $manager->option->get_license_status();
	if ( $status !== 'active' ) {
		return;
	}

	new Integrations\Oxygen;
	new Integrations\Bricks;
	new Integrations\Breakdance;
	new Integrations\ZionBuilder;

	$renderer = Renderer\Factory\Factory::make( new Renderer\VariableRenderer( new Renderer\Data ) );
	$renderer->setup();
}
