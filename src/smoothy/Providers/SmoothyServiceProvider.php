<?php

namespace Smoothy\Providers;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Collective\Html\HtmlServiceProvider;
use Devitek\Core\Translation\TranslationServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Smoothy\Api\SmoothyApi;
use Smoothy\Middleware\SetupApi;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;
use Spatie\CookieConsent\CookieConsentServiceProvider;

class SmoothyServiceProvider extends ServiceProvider
{
    /**
     * List of service providers.
     *
     * @var array
     */
    private $providers = [
        TranslationServiceProvider::class,
        HtmlServiceProvider::class,
        LaravelLocalizationServiceProvider::class,
        RouteServiceProvider::class,
        CookieConsentServiceProvider::class,
        CollectionMacroServiceProvider::class,
    ];

    /**
     * List of aliases.
     *
     * @var array
     */
    private $aliases = [
        'Form' => FormFacade::class,
        'HTML' => HtmlFacade::class,
        'LaravelLocalization' => LaravelLocalization::class,
    ];

    /**
     * List of middleware.
     *
     * @var array
     */
    private $middleware = [
        'api-setup' => SetupApi::class,
        'localize' => LaravelLocalizationRoutes::class,
        'localizationRedirect' => LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => LocaleSessionRedirect::class,
        'localeCookieRedirect' => LocaleCookieRedirect::class,
    ];

    /**
     * List of config files.
     *
     * @var array
     */
    private $config = [
        'smoothy' => 'smoothy.php',
        'laravellocalization' => 'laravellocalization.php'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigFiles(); // must registered before the service providers
        $this->registerServiceProviders();
        $this->registerAliases();
        $this->registerMiddleware();

        Collection::macro('toAssoc', function () {
            return $this->reduce(function ($assoc, $keyValuePair) {
                list($key, $value) = $keyValuePair;
                $assoc[$key] = $value;
                return $assoc;
            }, new static);
        });

        Collection::macro('mapToAssoc', function ($callback) {
            return $this->map($callback)->toAssoc();
        });

        $this->app->singleton(SmoothyApi::class, function () {
            return new SmoothyApi();
        });
    }

    /**
     * Boot method for the provider. Called after all the services have been registered.
     */
    public function boot()
    {
        if (!\App::environment('local'))
            \URL::forceSchema('https');

        $this->bootAssets();
        $this->bootViews();
        $this->bootLanguageFiles();
    }

    /**
     * Register the service providers, listed in $providers.
     */
    private function registerServiceProviders()
    {
        foreach ($this->providers as $provider)
            $this->app->register($provider);
    }

    /**
     * Register the aliases, listed in $aliases.
     */
    private function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->aliases as $alias => $class)
            $loader->alias($alias, $class);
    }

    /**
     * Register the middleware, listed in $middleware.
     */
    private function registerMiddleware()
    {
        foreach ($this->middleware as $name => $class)
            $this->app['router']->middleware($name, $class);
    }

    /**
     * Boot all the assets of the package.
     */
    private function bootAssets()
    {
        $this->publishes([
            '../../resources/assets/sass' => resource_path('assets/sass'),
            '../../resources/assets/fonts' => public_path('fonts'),
        ], 'update');

        $this->publishes([
            '../../resources/assets/js' => resource_path('assets/js'),
            '../../package.json' => base_path('package.json'),
            '../../gulpfile.js' => base_path('gulpfile.js'),
        ], 'init');
    }

    /**
     * Boot all the views in the resources/views directory.
     */
    private function bootViews()
    {
        $this->loadViewsFrom('../../resources/views', 'smoothy');
    }

    /**
     * Boot all the language files in the resources/lang directory.
     */
    private function bootLanguageFiles()
    {
        $this->loadTranslationsFrom('../../resources/lang/vendor/cookieConsent', 'cookieConsent');
        $this->loadTranslationsFrom('../../resources/lang', 'smoothy');
    }

    /**
     * Boot all the config files, listed in $config.
     */
    private function registerConfigFiles()
    {
        foreach ($this->config as $namespace => $file)
            $this->mergeConfigFrom('../../config/'.$file, $namespace);
    }
}