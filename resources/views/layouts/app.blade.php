<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('core/bootstrap.css') }}">
        @stack('styles')
    </head>
    <body>
        <div class="wrapper">
            @include('dashing::layouts.sidebar')
            <div class="main">
            @include('dashing::layouts.navbar')
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h1 class="h3 mb-3">{{ $header ?? '' }}</h1>
                        </div>
                        <div class="col-auto ms-auto text-left mt-n1">
                            {{ $breadcrumb ?? \Breadcrumbs::render('home') }}
                        </div>
                    </div>
                    <div class="row">
                        {{ $slot }}
                    </div>
                </div>
                <div id="overlayLoader">
                    <div class="d-flex justify-content-center position-absolute top-50 start-50 translate-middle text-white">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </main>
            @include('dashing::layouts.footer')
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('core/core.js') }}"></script>
        <script src="{{ mix('core/bootstrap.js') }}"></script>
        <script src="{{ mix('core/editor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/datatableformhandling.min.js') }}"></script>
        @routes
        <x-dashing::pusher-script/>
        @stack('scripts')
    </body>
</html>
