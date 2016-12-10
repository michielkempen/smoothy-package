# Smoothy package

A Laravel 5 package to kickstart your [Smoothy](https://smoothy.nu) application.

## Installation

You can install this package via composer using:

```
composer require michielkempen/smoothy-package
```

### Service providers

Remove the code below from `config/app.php`

```php
'providers' => [
    App\Providers\RouteServiceProvider::class,
]
```

Add the code below to `config/app.php`

```php
'providers' => [
    \Smoothy\Providers\SmoothyServiceProvider::class,
]
```

### Middleware

Add the code below to `app/Http/Kernel.php`

```php
protected $middlewareGroups = [

    'web' => [
        \Smoothy\Api\Setup\Middleware\SetupSmoothyApi::class,
        \Smoothy\Middleware\CheckSmoothyStatus::class,
        \Smoothy\Middleware\CheckWebsiteStatus::class,
    ],
    
];
```

### API configuration

Add the following variables to `.env`

```
CACHE_DRIVER                        = redis

SMOOTHY_API_ENABLED                 = true
SMOOTHY_API_CLIENT_ID               = ...
SMOOTHY_API_CLIENT_SECRET           = ...

SMOOTHY_IMAGE_MANIPULATION_SECRET   = ...
SMOOTHY_LICENSE_ID                  = ...

SMOOTHY_CACHE_HOST                  = ...
SMOOTHY_CACHE_PASSWORD              = ...
```

Add the code below to `app/config/cache.php`

```php
'stores' => [

    'smoothy_cdn' => [
        'driver' => 'redis',
        'connection' => 'smoothy_cdn',
    ],

    'smoothy_access_tokens' => [
        'driver' => 'redis',
        'connection' => 'smoothy_access_tokens',
    ],
    
],
```

Add the code below to `app/config/database.php`

```php
'redis' => [

    'smoothy_cdn' => [
        'host' => env('SMOOTHY_CACHE_HOST'),
        'password' => env('SMOOTHY_CACHE_PASSWORD'),
        'port' => env('SMOOTHY_CACHE_PORT', 6379),
        'database' => env('SMOOTHY_CACHE_STORE', 0),
    ],

    'smoothy_access_tokens' => [
        'host' => env('SMOOTHY_CACHE_HOST'),
        'password' => env('SMOOTHY_CACHE_PASSWORD'),
        'port' => env('SMOOTHY_CACHE_PORT', 6379),
        'database' => 2,
    ],

],
```

### Assets

Run `php artisan vendor:publish --provider="Smoothy\Providers\SmoothyServiceProvider" --force`.

Install the dependencies `npm install`.

Set browserSync proxy in `gulpfile.js`.

Execute `gulp`.

## Usage

### Update assets

Run `php artisan vendor:publish --provider="Smoothy\Providers\SmoothyServiceProvider" --tag=update --force`

### Views

```
@extends("smoothy::master")

@section("app_meta")

    <!-- meta data -->

@stop

@section("styles")

    <!-- additional styles -->

@stop

@section("page")

    <!-- content -->

@stop

@section("scripts")

    <!-- additional scripts -->

@stop
```

### Routes

```
registerGet(
    trans('routes.news').'/{article}',
    'news.show',
    \App\Http\Controllers\NewsController::class.'@show'
);
```