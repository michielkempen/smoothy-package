<?php

namespace Smoothy\Providers;

use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider;
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
use Smoothy\Foundation\Images\ImageManipulator;
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
        SlugifyServiceProvider::class,
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
        'Slugify' => SlugifyFacade::class,
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
        'smoothyapi' => 'smoothyapi.php',
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
        $this->registerImageManipulator();
    }

    /**
     * Boot method for the provider. Called after all the services have been registered.
     */
    public function boot()
    {
        if(env('SCHEME', 'http') == 'https')
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
     * Register the ImageManipulator.
     */
    private function registerImageManipulator()
    {
        $this->app->singleton(ImageManipulator::class, function() {
            return new ImageManipulator(smoothy_config('image-manipulation-secret'));
        });
    }

    /**
     * Boot all the assets of the package.
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets/sass' => resource_path('assets/sass'),
            __DIR__.'/../../resources/assets/fonts' => public_path('fonts'),
        ], 'update');

        $this->publishes([
            __DIR__.'/../../package.json' => base_path('package.json'),
            __DIR__.'/../../gulpfile.js' => base_path('gulpfile.js'),
            __DIR__.'/../../config/smoothyapi.php' => config_path('smoothyapi.php'),
        ], 'init');
    }

    /**
     * Boot all the views in the resources/views directory.
     */
    private function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'smoothy');
    }

    /**
     * Boot all the language files in the resources/lang directory.
     */
    private function bootLanguageFiles()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang/vendor/cookieConsent', 'cookieConsent');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'smoothy');
    }

    /**
     * Boot all the config files, listed in $config.
     */
    private function registerConfigFiles()
    {
        foreach ($this->config as $namespace => $file)
            $this->mergeConfigFrom(__DIR__.'/../../config/'.$file, $namespace);
    }
}