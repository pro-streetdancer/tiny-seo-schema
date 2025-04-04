<?php
namespace SlimSEOPro\Schema\Renderer;

use eLightUp\Twig\Environment;
use eLightUp\Twig\Loader\ArrayLoader;

class VariableRenderer {
	private $data_object;
	private $data = [];

	public function __construct( Data $data_object ) {
		$this->data_object = $data_object;
	}

	/**
	 * Render a single prop.
	 *
	 * A prop can be rendered as an array (multiple/cloneable fields from Meta Box) or a simple string.
	 * Because of that, we have to render each variable and combine later.
	 */
	public function render( string &$value, bool $is_faq = false ): void {
		// Don't render if no variables.
		if ( ! str_contains( $value, '{{' ) ) {
			// Parse shortcodes, blocks, etc.
			$value = Normalizer::normalize( $value, $is_faq );
			return;
		}

		preg_match_all( '#{{\s*?([^}\s]+?)\s*?}}#', $value, $matches, PREG_PATTERN_ORDER );

		// One variable.
		if ( count( $matches[0] ) === 1 ) {
			$var       = $matches[0][0];
			$var_value = $this->render_variable( $var );
			// Allows to parse post.categories as array. In case of string, allow both dynamic and static texts.
			$value = is_array( $var_value ) ? $var_value : strtr( $value, [ $var => $var_value ] );

			// Parse shortcodes, blocks, etc.
			$value = Normalizer::normalize( $value );
			return;
		}

		// If many variables in the prop, render each one and replace later.
		$replacements = [];
		$count        = 1;
		foreach ( $matches[0] as $var ) {
			$var_value            = $this->render_variable( $var );
			$replacements[ $var ] = $var_value;
			if ( is_array( $var_value ) ) {
				$count = max( $count, count( $var_value ) );
			}
		}

		$return = [];
		for ( $i = 0; $i < $count; $i++ ) {
			$row_replacements = [];
			foreach ( $replacements as $var => $var_value ) {
				$replacement              = is_array( $var_value ) ? ( $var_value[ $i ] ?? '' ) : $var_value;
				$row_replacements[ $var ] = $replacement;
			}
			$return[] = strtr( $value, $row_replacements );
		}

		$value = $count === 1 ? reset( $return ) : $return;

		// Parse shortcodes, blocks, etc.
		$value = Normalizer::normalize( $value, $is_faq );
	}

	/**
	 * Render a single variable.
	 *
	 * A variable can be rendered as an array (multiple/cloneable fields from Meta Box) or a simple string.
	 * In this case, need to use json_encode() & json_decode() to parse a variable to an array.
	 *
	 * @link https://stackoverflow.com/q/64858073/371240
	 */
	private function render_variable( $variable ) {
		ActiveVariable::set( trim( $variable, ' {}' ) );

		$raw = str_replace( '}}', '| json_encode() | raw }}', $variable );

		$loader = new ArrayLoader( compact( 'raw' ) );
		$twig   = new Environment( $loader, [ 'autoescape' => false ] );
		$value  = $twig->render( 'raw', $this->get_data() );
		$value  = json_decode( $value, true );
		$value  = Normalizer::normalize( $value );

		ActiveVariable::pop();

		return $value;
	}

	private function get_data(): array {
		if ( ! empty( $this->data ) ) {
			return $this->data;
		}

		// Collect all data.
		$this->data = $this->data_object->collect();

		// Parse variable in Slim SEO's metas.
		if ( ! empty( $this->data['slim_seo'] ) ) {
			array_walk( $this->data['slim_seo'], [ $this, 'render' ] );
		}

		if ( empty( $this->data['schemas'] ) ) {
			return $this->data;
		}

		// Render schemas' @id which can be like `{{ current.url }}#webpage`.
		foreach ( $this->data['schemas'] as &$id_value ) {
			$this->render( $id_value['@id'] );
		}

		return $this->data;
	}
}
