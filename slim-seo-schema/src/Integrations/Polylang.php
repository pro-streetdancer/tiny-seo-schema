<?php
namespace SlimSEOPro\Schema\Integrations;

use SlimSEOPro\Schema\Settings;

class Polylang {
	public function is_active(): bool {
		return defined( 'POLYLANG_VERSION' );
	}

	public function setup(): void {
		add_filter( 'slim_seo_schema_settings_enqueue', [ $this, 'add_language_for_js' ] );

		// Register translatable options
		new \PLL_Translate_Option(
			Settings::OPTION_NAME,
			[
				'*' => 1, // Translate all fields
			],
			[
				'context' => 'Slim SEO Schema',
			]
		);
	}

	public function add_language_for_js(): void {
		wp_add_inline_script( 'slim-seo-schema', 'var sssLang = "' . $this->get_admin_language() . '";', 'before' );
	}

	private function get_admin_language(): string {
		return PLL()->filter_lang ? PLL()->filter_lang->slug : '';
	}
}