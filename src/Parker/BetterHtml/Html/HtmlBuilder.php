<?php namespace Parker\BetterHtml\Html;

use Traversable;
use Illuminate\Html\HtmlBuilder as BaseHtmlBuilder;
use Illuminate\Support\Collection;

/**
 * Improves Laravel 4's built-in HtmlBuilder with raw HTML and more tags.
 * 
 * @author Bailey Parker <b@ileyparker.com>
 * @package laravel-betterhtml
 * @link https://github.com/baileyparker/laravel-betterhtml
 */
class HtmlBuilder extends BaseHtmlBuilder {
	
	/**
	 * Many (some have custom methods) of the extra tags added by Better HtmlBuilder.
	 * 
	 * Some elements are excluded purposely, others because they are handled by another
	 * (upcoming) package (table), and the rest are unimplemented due to special treatment
	 * necessary.
	 * 
	 * Not included: table tags (table, caption, colgroup, col, tbody, thead, tfoot, tr, td, th),
	 *  audio/video tags (video, audio, source, track), dl, dd, dt, hr, map, object, param, embed, area
	 * 
	 * @var array
	 */
	protected static $otherHtmlTags = array('noscript', 'template', 'section', 'nav', 'article', 'aside',
		'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'header', 'footer', 'address', 'main', 'p', 'pre', 'blockquote',
		'canvas', 'figure', 'figcaption', 'div', 'em', 'strong', 'small', 's', 'cite', 'q', 'dfn', 'abbr',
		'data', 'time', 'code', 'samp', 'kbd', 'sub', 'sup', 'i', 'b', 'u', 'mark', 'ruby', 'rt', 'rp', 'bdi',
		'bdo', 'span', 'ins', 'del', 'details', 'summary', 'menuitem', 'menu');

	/**
	 * The registered raw macros (return RawHtml instances).
	 *
	 * @var array
	 */
	protected $rawMacros = array();

	/**
	 * Flags the content as raw (not escaped by HtmlBuilder::entities()).
	 * 
	 * @param   string  $html
	 * @return  \Parker\BetterHtml\Html\RawHtml
	 */
	public function raw($html) {

		if(is_object($html) && $html instanceof RawHtml) {

			return $html;
		}

		if(is_array($html) || $html instanceof Collection || $html instanceof Traversable) {

			return $this->rawMany($html);
		}

		return new RawHtml($html);
	}

	/**
	 * Apply HtmlBuilder::raw() over a collection.
	 * 
	 * @param   mixed  $collection
	 * @return  mixed
	 */
	protected function rawMany($collection) {

		$that = $this;
		$mapRaw = function($value) use($that) {

			return $that->raw($value);
		};

		if($collection instanceof Collection) {

			return $html->map($mapRaw);
		}

		if($collection instanceof Traversable) {

			$collection = iterator_to_array($collection);
		}

		return array_map($mapRaw, (array) $collection);
	}

	/**
	 * Convert an HTML string to entities.
	 *
	 * @param  mixed  $value
	 * @return string
	 */
	public function entities($value) {

		if(is_object($value) && $value instanceof RawHtml) {

			return (string) $value;
		}

		return parent::entities($value);
	}

	/**
	 * Generate a link to a JavaScript file.
	 *
	 * @param  string  $url
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function script($url, $attributes = array(), $secure = null) {

		return $this->raw(parent::script($url, $attributes, $secure));
	}

	/**
	 * Generate a link to a CSS file.
	 *
	 * @param  string  $url
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function style($url, $attributes = array(), $secure = null) {

		return $this->raw(parent::style($url, $attributes, $secure));
	}

	/**
	 * Generate an HTML image element.
	 *
	 * @param  string  $url
	 * @param  string  $alt
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function image($url, $alt = null, $attributes = array(), $secure = null) {

		return $this->raw(parent::image($url, $alt, $attributes, $secure));
	}

	/**
	 * Generate a HTML link.
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function link($url, $title = null, $attributes = array(), $secure = null) {

		return $this->raw(parent::link($url, $title, $attributes, $secure));
	}

	/**
	 * Generate a HTTPS HTML link.
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function secureLink($url, $title = null, $attributes = array()) {
		
		return $this->raw(parent::secureLink($url, $title, $attributes));
	}

	/**
	 * Generate a HTML link to an asset.
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function linkAsset($url, $title = null, $attributes = array(), $secure = null) {

		return $this->raw(parent::linkAsset($url, $title, $attributes, $secure));
	}

	/**
	 * Generate a HTTPS HTML link to an asset.
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function linkSecureAsset($url, $title = null, $attributes = array()) {
		
		return $this->raw(parent::linkSecureAsset($url, $title, $attributes));
	}

	/**
	 * Generate a HTML link to a named route.
	 *
	 * @param  string  $name
	 * @param  string  $title
	 * @param  array   $parameters
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function linkRoute($name, $title = null, $parameters = array(), $attributes = array()) {

		return $this->raw(parent::linkRoute($name, $title, $parameters, $attributes));
	}

	/**
	 * Generate a HTML link to a controller action.
	 *
	 * @param  string  $action
	 * @param  string  $title
	 * @param  array   $parameters
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function linkAction($action, $title = null, $parameters = array(), $attributes = array()) {

		return $this->raw(parent::linkAction($action, $title, $parameters, $attributes));
	}

	/**
	 * Generate a HTML link to an email address.
	 *
	 * @param  string  $email
	 * @param  string  $title
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function mailto($email, $title = null, $attributes = array()) {

		return $this->raw(parent::mailto($email, $title, $attributes));
	}

	/**
	* Generate an ordered list of items.
	*
	* @param  array   $list
	* @param  array   $attributes
	* @return \Parker\BetterHtml\Html\RawHtml
	*/
	public function ol($list, $attributes = array()) {
	
		return $this->raw(parent::ol($list, $attributes));
	}

	/**
	* Generate an un-ordered list of items.
	*
	* @param  array   $list
	* @param  array   $attributes
	* @return \Parker\BetterHtml\Html\RawHtml
	*/
	public function ul($list, $attributes = array()) {

		return $this->raw(parent::ul($list, $attributes));
	}

	/**
	 * Generate an iframe element.
	 * 
	 * @param  string  $href
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function iframe($src, $attributes = array()) {

		$attributes['src'] = $src;

		$attributes = $this->attributes($attributes);

		return $this->raw("<iframe{$attributes}></iframe>");
	}

	/**
	 * Generate a meta element.
	 * 
	 * @param  string  $name
	 * @param  string  $content
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function meta($name, $content, $attributes = array()) {

		$attributes['name'] = $name;
		$attributes['content'] = $content;

		$attributes = $this->attributes($attributes);

		return $this->raw("<meta{$attributes}>");
	}

	/**
	 * Generate a meta description element.
	 * 
	 * @param  string  $description
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function description($description) {

		return $this->meta('description', $description);
	}

	/**
	 * Generate a link element.
	 * 
	 * @param  string  $href
	 * @param  string  $target
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function headLink($rel, $href, $attributes = array()) {

		$attributes['rel'] = $rel;
		$attributes['href'] = $href;

		$attributes = $this->attributes($attributes);

		return $this->raw("<link{$attributes}>");
	}

	/**
	 * Generate a base element.
	 * 
	 * @param  string  $href
	 * @param  string  $target
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function base($href, $target = null) {

		$attributes = array('href' => $href);

		if(!is_null($target)) {

			$attributes['target'] = $target;
		}

		$attributes = $this->attributes($attributes);

		return $this->raw("<base{$attributes}>");
	}

	/**
	 * Creates an arbitrary tag (optional) children and attributes.
	 * 
	 * @param  string  $name
	 * @param  mixed   $children
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function tag($name, $children = array(), $attributes = array()) {

		$html = '';

		foreach((array)$children as $child) {

			$html .= $this->entities($child);
		}

		$attributes = $this->attributes($attributes);

		return $this->raw("<{$name}{$attributes}>{$html}</{$name}>");
	}

	/**
	 * Wrap elements in any iteratable with a tag with (optional) attributes.
	 * 
	 * @param  string  $name
	 * @param  mixed   $elements
	 * @param  array   $attributes
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	public function wrap($name, $elements = array(), $attributes = array()) {

		$html = '';

		foreach((array)$elements as $element) {

			$html .= $this->tag($name, array($element), $attributes);
		}

		return $this->raw($html);
	}

	/**
	 * Register a raw macro.
	 *
	 * @param  string    $name
	 * @param  callable  $macro
	 * @return void
	 */
	public function rawMacro($name, $rawMacro) {

		$this->rawMacros[$name] = $rawMacro;
	}

	/**
	 * Checks if a raw macro is registered.
	 *
	 * @param  string    $name
	 * @return boolean
	 */
	public function hasRawMacro($name) {

		return isset($this->rawMacros[$name]);
	}

	/**
	 * Calls a raw macro.
	 *
	 * @param  string    $name
	 * @param  array     $parameters
	 * @return \Parker\BetterHtml\Html\RawHtml
	 */
	protected function callRawMacro($name, $parameters = array()) {

		return $this->raw(call_user_func_array($this->rawMacros[$name], $parameters));
	}

	/**
	 * Dynamically handle calls to the class.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public static function __call($method, $parameters) {

		// Allow tag calls in the form of Html::tagName([children], [attributes])
		if(in_array($method, static::$otherHtmlTags)) {

			array_unshift($parameters, $method);

			return call_user_func_array(array($this, 'tag'), $parameters);
		}

		if($this->hasRawMacro($method)) {

			return $this->callRawMacro($method, $parameters);
		}

		parent::__call($method, $parameters);
	}
}
