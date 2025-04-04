<?php
/**
 * Track how many cloneable props are being processed.
 */

namespace SlimSEOPro\Schema\Renderer;

class CloneableProps {
	private static $count = 0;

	public static function increase() {
		self::$count++;
	}

	public static function decrease() {
		self::$count--;
	}

	public static function empty() {
		return self::$count === 0;
	}
}
