<?php
/**
 * Plugin Name: Tiny SEO Schema
 * Description: A modified schema builder plugin for WordPress.
 * Author:      Anon
 * Version:     2.7.1
 * Text Domain: slim-seo-schema
 * Domain Path: /languages/
 *
 * Copyright (C) 2010-2025 Tran Ngoc Tuan Anh. All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

defined( 'ABSPATH' ) || die;

add_action( 'plugins_loaded', function () {
	if ( ! defined( 'SLIM_SEO_SCHEMA_URL' ) ) {
		define( 'SLIM_SEO_SCHEMA_URL', plugin_dir_url( __FILE__ ) );
	}

	if ( ! defined( 'SLIM_SEO_SCHEMA_DIR' ) ) {
		define( 'SLIM_SEO_SCHEMA_DIR', __DIR__ );
	}

	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require __DIR__ . '/vendor/autoload.php';
	}
	require __DIR__ . '/bootstrap.php';
} );
