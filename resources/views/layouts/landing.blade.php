<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>

    <meta name="description" content="@yield('meta_description', 'SamaRemorque - Plateforme de remorquage et depannage routier au Senegal. Trouvez rapidement un remorqueur ou un depanneur pres de vous a Dakar et partout au Senegal.')">
    <meta name="keywords" content="@yield('meta_keywords', 'remorquage Dakar, depannage routier Senegal, remorqueur Dakar, depanneur Senegal, assistance routiere 24/7')">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="geo.region" content="SN">
    <meta name="geo.placename" content="Dakar">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Service de remorquage et depannage routier au Senegal.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('favicon.jpg'))">
    <meta property="og:locale" content="fr_SN">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Service de remorquage et depannage routier au Senegal.')">
    <meta name="twitter:image" content="@yield('og_image', asset('favicon.png'))">

    <meta name="theme-color" content="#0c1222">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = 'build/' . ($manifest['resources/css/app.css']['file'] ?? 'app.css');
        $jsFile = 'build/' . ($manifest['resources/js/app.js']['file'] ?? 'app.js');
    @endphp
    <link rel="stylesheet" href="{{ asset($cssFile) }}">
    <script defer src="{{ asset($jsFile) }}"></script>
</head>
<body class="font-sans antialiased bg-night text-slate-900 landing-page">
    <div id="scroll-progress" aria-hidden="true"></div>
    @yield('content')
    @stack('scripts')
</body>
</html>
