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
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = 'build/' . ($manifest['resources/css/app.css']['file'] ?? 'app.css');
        $jsFile = 'build/' . ($manifest['resources/js/app.js']['file'] ?? 'app.js');
    @endphp
    <link rel="stylesheet" href="{{ asset($cssFile) }}">
    <script defer src="{{ asset($jsFile) }}"></script>
    @livewireStyles
</head>
<body class="font-sans antialiased bg-night-50 text-slate-900">
    <div id="app" class="min-h-screen flex flex-col">
        @hasSection('hide_nav')
        @else
            @include('layouts.partials.navbar')
        @endif

        <main id="main-content" class="flex-1">
            @if(session('status'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        @hasSection('hide_footer')
        @else
            @include('layouts.partials.footer')
        @endif
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            userId: {{ auth()->id() ?? 'null' }},
            userRole: '{{ auth()->user()?->role ?? "guest" }}',
            pusherKey: '{{ config("broadcasting.connections.reverb.key") }}',
            pusherCluster: '{{ config("broadcasting.connections.pusher.options.cluster") }}',
        };
    </script>
    @livewireScripts
    @auth
        <script>
            (function () {
                const badge = document.getElementById('unread-badge');
                if (!badge) return;
                function refresh() {
                    fetch('{{ route('notifications.unread-count') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.json())
                        .then(data => {
                            const n = data.unread;
                            if (n > 0) {
                                badge.textContent = n > 99 ? '99+' : n;
                                badge.classList.remove('hidden');
                            } else {
                                badge.classList.add('hidden');
                            }
                        })
                        .catch(() => {});
                }
                setInterval(refresh, 15000);
            })();
        </script>
    @endauth
    @stack('scripts')
</body>
</html>
