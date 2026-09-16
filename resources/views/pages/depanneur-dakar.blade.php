@extends('layouts.app')
@section('title', 'Depanneur Dakar - SamaRemorque | Depanneur verifie a Dakar, Pikine, Rufisque')
@section('content')
<x-page-hero
    title="Trouvez un dépanneur vérifié à Dakar en quelques clics"
    subtitle="Dépannage sur place et remorquage à Dakar, Pikine et Rufisque. Intervention rapide 24/7, tarif transparent, suivi en temps réel."
    eyebrow="Dépanneur Dakar"
>
    <x-slot:actions>
        <a href="{{ route('guest.create') }}" class="landing-cta-primary">Demander une assistance</a>
        <a href="#services" class="landing-cta-ghost">Voir nos services</a>
    </x-slot:actions>
</x-page-hero>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Pourquoi choisir SamaRemorque pour trouver un dépanneur ?</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['title' => 'Dépanneurs vérifiés', 'desc' => 'Tous les dépanneurs sont validés par notre équipe. Vous consultez leur profil et leur évaluation avant de choisir.'],
                ['title' => 'Intervention rapide', 'desc' => 'Mise en relation en quelques minutes. Suivez l\'arrivée du dépanneur sur la carte en temps réel.'],
                ['title' => 'Tarifs transparents', 'desc' => 'Les tarifs horaires sont affichés. Pas de surprise, vous connaissez le coût avant de choisir.']
            ] as $i => $item)
            <div>
                <span class="font-display text-5xl font-bold text-accent-500/20">0{{ $i + 1 }}</span>
                <h3 class="mt-2 font-display text-xl font-semibold text-night">{{ $item['title'] }}</h3>
                <p class="mt-2 text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Nos services de dépannage</h2>
        <p class="mt-3 text-lg text-slate-500 max-w-2xl">Dépannage sur place et remorquage à Dakar, Pikine et Rufisque.</p>
        <div class="mt-12 divide-y divide-slate-200 border-y border-slate-200">
            @foreach([
                ['title' => 'Dépannage batterie', 'desc' => 'Batterie à plat : le dépanneur intervient directement sur place pour vous remettre en route.'],
                ['title' => 'Dépannage crevaison', 'desc' => 'Crevaison ou pneu crevé : le dépanneur remplace ou répare le pneu sur place.'],
                ['title' => 'Remorquage', 'desc' => 'Transport sécurisé vers le garage de votre choix si le dépannage sur place n\'est pas possible.']
            ] as $i => $service)
            <div class="py-8 md:py-10 flex flex-col md:flex-row md:items-baseline gap-3 md:gap-12">
                <span class="font-display text-sm font-semibold text-accent-500 tracking-widest uppercase w-12">0{{ $i + 1 }}</span>
                <h3 class="font-display text-2xl font-semibold text-night md:w-72 shrink-0">{{ $service['title'] }}</h3>
                <p class="text-slate-600 leading-relaxed max-w-xl">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
        <div class="mt-12">
            <a href="{{ route('guest.create') }}" class="landing-cta-primary !inline-flex">Demander une assistance</a>
        </div>
    </div>
</section>

<section class="landing-cta-band relative py-20 md:py-28 overflow-hidden">
    <div class="relative max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white tracking-tight">Besoin d'un dépanneur à Dakar ?</h2>
        <p class="mt-4 text-lg text-white/80">Demandez une assistance maintenant et soyez mis en relation avec un dépanneur disponible près de vous.</p>
        <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-white text-night hover:bg-night-100 font-semibold px-8 py-4 rounded-xl text-lg transition-all hover:scale-[1.02]">Demander une assistance</a>
    </div>
</section>
@endsection
