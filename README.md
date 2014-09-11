A Better `HtmlBuilder` for Laravel 4
====================================

> An expanded, backwards compatible `HtmlBuilder` for Laravel 4 which features raw HTML (and nesting builder methods), methods for [all HTML5 tags](https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5/HTML5_element_list), convenience functions for common tasks like creating `<meta name="description">` tags, and simple wrapping capabilities.

## Usage

    {{ Html::div(Html::linkAction('HomeController@index', 'Back to Home'), ['class' => 'home-link']) }}

    {{ Html::nav(Html::ul([

        Html::linkAction('HomeController@index', 'Home'),
        Html::linkAction('AboutUsController@index', 'About Us'),
        Html::linkAction('BlogController@index', 'Blog'),
        Html::linkAction('ContactController@form', 'Contact Us'),

    ], ['class' => 'navigation-list'])) }}

## Installation

First, add the following line to `"require"` in your `composer.json`:

    "parker/laravel-betterhtml": "~0.1"

Next, run `composer update` from the command line. After that, need to replace the following service provider in your `app.php` config file (feel free to comment it out):

	'Illuminate\Html\HtmlServiceProvider',

with this:

	'Parker\BetterHtml\Html\HtmlServiceProvider',

To be able to access Better HtmlBuilder with the `HTML` facade, you need to replace the following alias in your `app.php` config file (feel free to comment it out):

	'HTML' => 'Illuminate\Support\Facades\HTML',

with this:

	'HTML' => 'Parker\BetterHtml\Support\Facades\HTML',

Additionally, because of the way that Laravel's `e()` helper is defined and used (see [laravel/framework PR #4783](https://github.com/laravel/framework/pull/4783)), you also need to include BetterHtml's custom `e()` helper in your `app/start/global.php`:

    /*
    |--------------------------------------------------------------------------
    | Load the Better HtmlBuilder helpers
    |--------------------------------------------------------------------------
    |
    | Here we load helpers for the Better HtmlBuilder so that they can
    | override ones provided by laravel in Illuminate\Support\helpers.php.
    |
    */

    $betterHtmlVendor = $app['path.base'] . '/vendor/parker/laravel-betterhtml';

    require $betterHtmlVendor . '/src/Parker/BetterHtml/Support/helpers.php';

## Contributing

Do you know a way that we can make Laravel's `HtmlBuilder` even better? Please submit your ideas in the form of an issue on this repository with your proposal and a sample use case. Bug pull requests are greatly appreciated (but reports are fine too if you can't track down the cause yourself).

## Requirements

 - PHP >= 5.4.0
 - Laravel 4.2

## License

BetterHtmlBuilder for Laravel 4 is open-sourced software licensed under the [MIT License](http://opensource.org/licenses/MIT).
