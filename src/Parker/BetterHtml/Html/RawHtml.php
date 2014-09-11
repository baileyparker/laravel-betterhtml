<?php namespace Parker\BetterHtml\Html;

/**
 * RawHtml is a wrapper class for HTML content that should not be escaped.
 * 
 * @see \Parker\BetterHtml\Html\HtmlBuilder::raw()
 * 
 * @author Bailey Parker <b@ileyparker.com>
 * @package laravel-betterhtml
 * @link https://github.com/baileyparker/laravel-betterhtml
 */
class RawHtml {

	/**
	 * The contents of the wrapper object.
	 * 
	 * @var string
	 */
	private $content;


	/**
	 * Create a new Raw HTML wrapper instance.
	 * 
	 * @param   string	$content
	 * @return  void
	 */
	public function __construct($content) {

		$this->content = (string) $content;
	}

	/**
	 * Get the contents of the wrapper object.
	 * 
	 * @return  string
	 */
	public function __toString() {

		return $this->content;
	}
}
