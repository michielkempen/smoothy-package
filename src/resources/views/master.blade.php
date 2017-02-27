<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ url('img/favicon.png') }}" type="image/x-icon" />
        @yield('app_meta')
        @yield('page_meta')
        {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css') !!}
        @yield('app_styles')
        @yield('page_styles')
    </head>
    <body>
        @yield('page')
        @include('cookieConsent::index')
        {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css') !!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js') !!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') !!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.1/switchery.min.js') !!}
        {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js') !!}
        @yield("app_scripts")
        @yield("page_scripts")
    </body>
</html>
