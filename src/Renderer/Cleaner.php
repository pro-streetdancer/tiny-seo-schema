<?php
namespace SlimSEOPro\Schema\Renderer;

class Cleaner {
	const MAIN_PROPS = [ '@id', '@type' ];

	public static function cleanup( array $props ): array {
		foreach ( $props as $key => $subprops ) {
			// Always keep main props.
			if ( in_array( $key, self::MAIN_PROPS, true ) ) {
				continue;
			}

			// Process subschema only.
			if ( ! is_array( $subprops ) || empty( $subprops['@type'] ) ) {
				continue;
			}

			$subprops = self::cleanup( $subprops );
			if ( empty( $subprops ) ) {
				unset( $props[ $key ] );
			}
		}

		$result = self::empty( $props ) ? [] : $props;
		return isset( $result['@type'] ) && $result['@type'] === 'FAQPage' ? self::clean_faq( $result ) : $result;
	}

	private static function empty( array $props ): bool {
		if ( empty( $props['@type'] ) ) {
			return false;
		}
		$main_props = self::MAIN_PROPS;
		if ( $props['@type'] === 'BreadcrumbList' ) {
			$main_props[] = 'name';
		}
		$diff = array_diff( array_keys( $props ), $main_props );
		return empty( $diff );
	}

	/**
	 * Cleans FAQ data by removing entities with missing name or acceptedAnswer.
	 *
	 * @param array $props The schema FAQ.
	 *
	 * @return array The cleaned schema FAQ.
	 */
	private static function clean_faq( array $props ): array {
		if ( ! isset( $props['mainEntity'] ) || ! is_array( $props['mainEntity'] ) ) {
			return [];
		}

		$entities = $props['mainEntity'];
		foreach ( $entities as $key => $entity ) {
			if ( empty( $entity['name'] ) || empty( $entity['acceptedAnswer']['text'] ) ) {
				unset( $entities[ $key ] );
			}
		}

		$props['mainEntity'] = array_values( $entities );
		return empty( $entities ) ? [] : $props;
	}
}