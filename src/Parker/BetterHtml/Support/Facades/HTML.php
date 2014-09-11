<?php namespace Parker\Support\BetterHtml\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Laravel 4 Facade for Better HtmlBuilder.
 * 
 * @see \Parker\BetterHtml\Html\HtmlBuilder
 * 
 * @author Bailey Parker <b@ileyparker.com>
 * @package laravel-betterhtml
 * @link https://github.com/baileyparker/laravel-betterhtml
 */
class HTML extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {

		return 'better-html';
	}
}
