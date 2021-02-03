<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="/images/innov_log.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
    </style>
    @yield('css_after')
    <title>@yield('title', 'Innovative Logistics')</title>
</head>
<body>
@include('shared.navigation')
<main class="container mt-3">
    @yield('main', 'Page under construction...')
    @include('shared.footer')
</main>
</body>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script_after')
</body>
</html>
