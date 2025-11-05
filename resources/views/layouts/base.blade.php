<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- SEO de base --}}
        <title>@yield('title', 'Noferu — Portfolio de Nawfel Ida-Ali')</title>
        <meta name="description" content="@yield('description', 'Portfolio de Nawfel Ida-Ali, développeur full-stack et créatif basé à Strasbourg.')">

        {{-- CSRF pour JS --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicons / PWA --}}
        {{-- <link rel="icon" type="image/svg+xml" href="/favicon.svg"> --}}
        {{-- <meta name="theme-color" content="#0a0e27"> --}}

        {{-- Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Styles additionnels injectés par les vues --}}
        @stack('styles')
    </head>
    <body class="min-h-screen bg-cosmos-bg text-cosmos-text font-sans antialiased">
        @include('partials.header')

        {{-- Ancre de contournement pour le lien "Aller au contenu" --}}
        <main id="main" class="container mx-auto px-4 py-8">
            @yield('content')
        </main>

        @include('partials.footer')

        {{-- Scripts additionnels injectés par les vues --}}
        @stack('scripts')
    </body>
</html>
