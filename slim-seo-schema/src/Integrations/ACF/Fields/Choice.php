<?php
namespace SlimSEOPro\Schema\Integrations\ACF\Fields;

class Choice extends Base {
	public function get_value() {
		$value = $this->field['value'];

		if ( isset( $value['label'] ) ) {
			return $value['label'];
		}

		$value = is_array( $value ) ? reset( $value ) : $value;

		return $value['label'] ?? $value;
	}
}
