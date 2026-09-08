<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Connexion') - {{ config('app.name') }}</title>

    <meta name="description" content="Connectez-vous a SamaRemorque - Plateforme de remorquage et depannage routier au Senegal.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('title', 'Connexion')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_SN">

    <meta name="theme-color" content="#0f172a">
    <link rel="icon" type="image/png" href="{{ asset('favicon.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center mb-4">
                <span class="inline-flex items-center justify-center w-20 h-20  rounded-lg bg-white shadow-lg ring-1 ring-slate-200 overflow-hidden">
                    <img src="{{ asset('favicon.jpg') }}" alt="{{ config('app.name') }}" class="w-16 h-16 object-contain">
                </span>
            </div>
            <h1 class="text-center text-3xl font-bold text-slate-900">{{ config('app.name') }}</h1>
            <p class="mt-2 text-center text-sm text-slate-600">Plateforme de remorquage et depannage routier</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
