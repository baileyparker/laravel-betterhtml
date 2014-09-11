<?php namespace Parker\BetterHtml\Html;

use Illuminate\Html\HtmlServiceProvider as BaseHtmlServiceProvider;

/**
 * Laravel 4 Service Provider for Better HtmlBuilder.
 * Replaces the builder with the enhanced one:
 * \Parker\BetterHtml\Html\HtmlBuilder.
 * 
 * @author Bailey Parker <b@ileyparker.com>
 * @package laravel-betterhtml
 * @link https://github.com/baileyparker/laravel-betterhtml
 */
class HtmlServiceProvider extends BaseHtmlServiceProvider {

	/**
	 * Boot the service.
	 * 
	 * @return void
	 */
	public function boot() {

		$this->package('parker/laravel-betterhtml');
	}

	/**
	 * Register the HTML builder instance.
	 *
	 * @return void
	 */
	protected function registerHtmlBuilder() {

		$this->app->bindShared('better-html', function($app)
		{
			return new HtmlBuilder($app['url']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {

		return array('better-html', 'form');
	}
}
