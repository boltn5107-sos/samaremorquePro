<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>

    {{-- SEO --}}
    <meta name="google-site-verification" content="5RZr_MjxvRBL_yoqOzX9gERC8ey1btQ61t2Og1WhVKY" />
    <meta name="description" content="@yield('meta_description', 'SamaRemorque - Plateforme de remorquage et depannage routier au Senegal. Trouvez rapidement un remorqueur ou un depanneur pres de vous.')">
    <meta name="keywords" content="remorquage, depannage, remorqueur, depanneur, panne, vehicule, Senegal, Dakar, assistance routiere, remorque voiture">
    <meta name="author" content="SamaRemorque">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Service de remorquage et depannage routier au Senegal. Trouvez un remorqueur ou depanneur proche de vous.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('favicon.png'))">
    <meta property="og:locale" content="fr_SN">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Service de remorquage et depannage routier au Senegal.')">
    <meta name="twitter:image" content="@yield('og_image', asset('favicon.png'))">

    {{-- Application --}}
    <meta name="theme-color" content="#0f172a">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "SamaRemorque",
  "description": "Plateforme de remorquage et depannage routier au Senegal",
  "url": "https://samaremorquepro.onrender.com",
  "telephone": "+221774467596",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Dakar",
    "addressCountry": "SN"
  }
}
</script>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div id="app">
        @include('layouts.partials.navbar')

        <main>
            @if(session('status'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        @include('layouts.partials.footer')
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
