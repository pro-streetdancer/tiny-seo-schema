<?php
namespace SlimSEOPro\Schema\Integrations;

use SlimSEOPro\Schema\Settings;

class WPML {
	public function is_active(): bool {
		return defined( 'ICL_SITEPRESS_VERSION' );
	}

	public function setup(): void {
		// Register translatable options
		do_action( 'wpml_multilingual_options', Settings::OPTION_NAME );
	}
}