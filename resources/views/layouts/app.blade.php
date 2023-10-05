<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/judiciary-icon.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Tool Procurement Centre | MoJ D&T') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('head')
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</head>
<body>
<script>document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');</script>
<a href="#main-content" class="govuk-skip-link">Skip to main content</a>

<x-header/>
<div class="govuk-width-container">
    <x-breadcrumbs :paths="$breadcrumbs"></x-breadcrumbs>
    <!-- Page Content -->
    <main class="govuk-main-wrapper " id="main-content" role="main">
        {{ $slot }}
    </main>

</div>
<x-footer/>

<script src="{{ asset('assets/js/govuk.js') }}"></script>
<script>
    window.GOVUKFrontend.initAll();
</script>
</body>
</html>
