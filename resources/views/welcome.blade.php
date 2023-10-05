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
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</head>
<body>
<script>document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');</script>
<x-header-guest/>


<div class="app-pane__content">
    <!-- Page Content -->
    <main class="govuk-main-wrapper " id="main-content" role="main">
        <div class="app-masthead">
            <div class="govuk-width-container">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-two-thirds-from-desktop">
                        <h1 class="govuk-heading-xl app-masthead__title">Take a deep-dive into tooling and discover
                            software usage across the MOJ</h1>
                        <p class="app-masthead__description">Login or register with your <code>justice.gov.uk</code> email
                            to view data charts and graphs, manage licencing, procure new software for your team, even
                            deliver feedback on current tooling use.</p>

                        <a href="{{ route('dashboard') }}" role="button" draggable="false"
                           class="govuk-button app-button--inverted govuk-!-margin-top-6 govuk-!-margin-bottom-0 govuk-button--start"
                           data-module="govuk-button">
                            Get started
                            <svg class="govuk-button__start-icon" xmlns="http://www.w3.org/2000/svg" width="17.5"
                                 height="19" viewBox="0 0 33 40" aria-hidden="true" focusable="false">
                                <path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="govuk-grid-column-one-third-from-desktop">
                        <img class="app-masthead__image" src="{{ asset('assets/chart-3.png') }}" alt=""
                             role="presentation">
                    </div>
                </div>
            </div>
        </div>
        <div class="govuk-width-container">
            <div class="govuk-main-wrapper govuk-main-wrapper--l">
                <div class="govuk-grid-row">
                    <div class="govuk-grid-column-two-thirds-from-desktop">
                        <h2 id="whats-new" class="govuk-heading-l">What’s new</h2>
                        <p class="govuk-body">COMING SOON! Discover data related to tooling within digital teams and
                            unveil exploratory reports and structured data for administrative review, financial
                            quantification and high-confidence decision making.</p>
                        <p class="govuk-body"><a href="{{ route('register') }}" class="govuk-link">Sign up to get update
                                emails from the Tooling Procurement Centre</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<x-footer/>

<script src="{{ asset('assets/js/govuk.js') }}"></script>
<script>
    window.GOVUKFrontend.initAll();
</script>
</body>
</html>
