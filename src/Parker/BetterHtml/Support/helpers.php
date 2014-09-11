<?php

if ( ! function_exists('e'))
{
	/**
	 * Escape HTML entities in a string.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function e($value) {

		return app('better-html')->entities($value);
	}
}
