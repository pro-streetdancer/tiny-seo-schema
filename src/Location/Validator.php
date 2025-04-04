<?php
namespace SlimSEOPro\Schema\Location;

use Error;

class Validator {
	private $location;
	private $type;

	public function __construct( $location ) {
		$this->location = $location;
		$this->type     = $this->get( 'type' );
	}

	public function validate() {
		if ( $this->type === 'site' ) {
			return true;
		}
		if ( ! $this->is_template_type() ) {
			return false;
		}
		$result = 'code' === $this->type ? $this->validate_code() : $this->validate_groups();
		return apply_filters( 'slim_seo_schema_location_validate', $result, $this->type, $this->location );
	}

	private function is_template_type() {
		if ( 'code' === $this->type ) {
			return true;
		}
		if ( 'singular' === $this->type ) {
			return is_singular();
		}
		if ( 'archive' === $this->type ) {
			return ! is_singular();
		}
		return false;
	}

	private function validate_code() {
		$code = trim( $this->get( 'code' ) );

		if ( '' === $code ) {
			return true;
		}

		if ( false === stristr( $code, 'return' ) ) {
			$code = "return ( $code );";
		}

		$result = false;
		try {
			$result = eval( $code );
		} catch ( Error $e ) {
			trigger_error( $e->getMessage(), E_USER_WARNING );
		}
		return $result;
	}

	private function validate_groups() {
		$groups = $this->get( "{$this->type}_locations" );
		if ( empty( $groups ) ) {
			return false;
		}
		foreach ( $groups as $group ) {
			if ( ! $this->validate_group( $group ) ) {
				return false;
			}
		}
		return true;
	}

	private function validate_group( $group ) {
		$method = "validate_rule_{$this->type}";
		foreach ( $group as $rule ) {
			if ( $this->{$method}( $rule ) ) {
				return true;
			}
		}
		return false;
	}

	private function validate_rule_archive( $rule ) {
		list ( $type, $subtype ) = explode( ':', $rule['name'] );
		if ( 'general' === $type ) {
			if ( 'author' === $subtype ) {
				return is_author();
			}
			if ( 'date' === $subtype ) {
				return is_year() || is_month() || is_day();
			}
			if ( 'search' === $subtype ) {
				return is_search();
			}
			return true;
		}
		if ( 'archive' === $subtype ) {
			return is_post_type_archive( $type );
		}
		if ( 'category' === $subtype && is_category() ) {
			$category = get_queried_object();
			return in_array( $rule['value'], [ 'all', $category->cat_ID ] );
		}
		if ( 'post_tag' === $subtype && is_tag() ) {
			$tag = get_queried_object();
			return in_array( $rule['value'], [ 'all', $tag->term_id ] );
		}

		$result = ( is_tax( $subtype ) && 'all' === $rule['value'] ) || is_tax( $subtype, (int) $rule['value'] );

		return apply_filters( 'slim_seo_schema_location_validate_archive', $result, $rule );
	}

	private function validate_rule_singular( $rule ) {
		list ( $type, $subtype ) = explode( ':', $rule['name'] );
		if ( 'general' === $type ) {
			return true;
		}
		if ( $type !== get_post_type() ) {
			return false;
		}
		if ( 'post' === $subtype ) {
			return in_array( $rule['value'], [ 'all', get_the_ID() ] );
		}

		$value = 'all' === $rule['value'] ? '' : $rule['value'];
		$result = has_term( $value, $subtype, null );

		return apply_filters( 'slim_seo_schema_location_validate_singular', $result, $rule );
	}

	private function get( $name ) {
		return $this->location[ $name ] ?? null;
	}
}