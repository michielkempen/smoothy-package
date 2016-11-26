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

### gulp

Run `php artisan vendor:publish --provider="Smoothy\Providers\SmoothyServiceProvider" --force`.

Install the dependencies `npm install`.

Set browserSync proxy in `gulpfile.js`.

Execute `gulp`.

## Usage

### views

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

### routes

```
registerGet(
    trans('routes.news').'/{article}',
    'news.show',
    \App\Http\Controllers\NewsController::class.'@show'
);
```