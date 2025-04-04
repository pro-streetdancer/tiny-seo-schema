<?php
namespace SlimSEOPro\Schema\Renderer;

class ActiveVariable {
	private static $variables = [];

	public static function set( $variable ) {
		self::$variables[] = $variable;
	}

	public static function get() {
		return end( self::$variables );
	}

	public static function pop() {
		array_pop( self::$variables );
	}
}
