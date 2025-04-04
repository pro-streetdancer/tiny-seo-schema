<?php
namespace SlimSEOPro\Schema\Integrations\ACF\Fields;

class Link extends Base {
	public function get_value() {
		$value = $this->field['value'];

		return $value['url'] ?? $value;
	}
}
