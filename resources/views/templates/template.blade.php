<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    </head>
    <body class="antialiased">
        <x-header />
        @if(session()->has('success'))
            <div id="success" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="container">
            @yield('content')
        </div>
        <x-footer :title="config('app.name')" />
        <script src="{{ asset('js/turbolinks.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
