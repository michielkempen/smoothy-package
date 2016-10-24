<?php

namespace Smoothy\Api\Setup\Providers;

use Illuminate\Support\ServiceProvider;
use Smoothy\Api\Responses\Images\ImageManipulator;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * List of service providers.
     *
     * @var array
     */
    private $providers = [
        CollectionMacroServiceProvider::class
    ];

    /**
     * List of config files.
     *
     * @var array
     */
    private $config = [
        'smoothy' => 'smoothy.php',
        'smoothyapi' => 'smoothyapi.php',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigFiles();
        $this->registerServiceProviders();
        $this->registerImageManipulator();
    }

    /**
     * Boot all the config files, listed in $config.
     */
    private function registerConfigFiles()
    {
        foreach ($this->config as $namespace => $file)
            $this->mergeConfigFrom(__DIR__.'/../../../../config/'.$file, $namespace);
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
     * Register the ImageManipulator.
     */
    private function registerImageManipulator()
    {
        $this->app->singleton(ImageManipulator::class, function() {
            return new ImageManipulator(smoothy_config('image-manipulation-secret'));
        });
    }

    /**
     * Boot method for the provider. Called after all the services have been registered.
     */
    public function boot()
    {
        $this->bootAssets();
    }

    /**
     * Boot all the assets of the package.
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../../../../config/smoothyapi.php' => config_path('smoothyapi.php'),
        ], 'init');
    }
}