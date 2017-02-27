<?php

namespace Smoothy\Providers;

use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider;
use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Collective\Html\HtmlServiceProvider;
use Devitek\Core\Translation\TranslationServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Smoothy\Api\Responses\Images\ImageManipulator;
use Smoothy\Middleware\ValidProxies;
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
        RouteServiceProvider::class,
        CookieConsentServiceProvider::class,
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
        'Slugify' => SlugifyFacade::class,
    ];

    /**
     * List of middleware.
     *
     * @var array
     */
    private $routeMiddleware = [
        'validProxies'
    ];

    /**
     * List of config files.
     *
     * @var array
     */
    private $config = [
        'smoothy' => 'smoothy.php'
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
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(ValidProxies::class);

        foreach ($this->routeMiddleware as $name => $class)
            $this->app['router']->middleware($name, $class);
    }

    /**
     * Boot all the assets of the package.
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets/sass' => resource_path('assets/sass'),
        ], 'update');

        $this->publishes([
            __DIR__.'/../../config/smoothy.php' => config_path('smoothy.php'),
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

    private function registerImageManipulator()
    {
        $this->app->singleton(ImageManipulator::class, function () {
            return new ImageManipulator(config('smoothy.image-secret'));
        });
    }
}