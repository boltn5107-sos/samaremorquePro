@extends('layouts.app')
@section('title', 'Depannage urgence Dakar - SamaRemorque | Depanneur urgent 24/7 a Dakar')
@section('content')
<x-page-hero
    title="Dépannage urgence à Dakar : intervention rapide 24/7"
    subtitle="En cas de panne à Dakar, Pikine ou Rufisque, trouvez un dépanneur vérifié en quelques minutes. Intervention rapide, tarif transparent, suivi en temps réel."
    eyebrow="Dépannage urgence Dakar"
>
    <x-slot:actions>
        <a href="{{ route('guest.create') }}" class="landing-cta-primary">Demander une assistance</a>
        <a href="#services" class="landing-cta-ghost">Voir nos services</a>
    </x-slot:actions>
</x-page-hero>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Dépannage urgence Dakar : notre engagement</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['title' => 'Disponible 24/7', 'desc' => 'Service disponible jour et nuit, y compris les week-ends et jours fériés à Dakar et sa région.'],
                ['title' => 'Dépanneurs vérifiés', 'desc' => 'Tous les dépanneurs sont vérifiés et notés par la communauté. Vous choisissez en toute confiance.'],
                ['title' => 'Suivi en temps réel', 'desc' => 'Suivez l\'arrivée du dépanneur sur la carte et recevez les mises à jour par état.']
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
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Nos services de dépannage urgence</h2>
        <p class="mt-3 text-lg text-slate-500 max-w-2xl">Interventions rapides pour tous les types de pannes à Dakar, Pikine et Rufisque.</p>
        <div class="mt-12 divide-y divide-slate-200 border-y border-slate-200">
            @foreach([
                ['title' => 'Dépannage batterie', 'desc' => 'Batterie à plat en urgence : le dépanneur intervient rapidement pour vous remettre en route.'],
                ['title' => 'Dépannage crevaison', 'desc' => 'Crevaison ou pneu crevé : le dépanneur remplace ou répare le pneu sur place.'],
                ['title' => 'Remorquage urgence', 'desc' => 'Transport urgent vers le garage de votre choix si le dépannage sur place n\'est pas possible.']
            ] as $i => $service)
            <div class="py-8 md:py-10 flex flex-col md:flex-row md:items-baseline gap-3 md:gap-12">
                <span class="font-display text-sm font-semibold text-accent-500 tracking-widest uppercase w-12">0{{ $i + 1 }}</span>
                <h3 class="font-display text-2xl font-semibold text-night md:w-72 shrink-0">{{ $service['title'] }}</h3>
                <p class="text-slate-600 leading-relaxed max-w-xl">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
        <div class="mt-12">
            <a href="{{ route('guest.create') }}" class="landing-cta-primary !inline-flex">Demander un dépannage urgent</a>
        </div>
    </div>
</section>

<section class="landing-cta-band relative py-20 md:py-28 overflow-hidden">
    <div class="relative max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white tracking-tight">En urgence à Dakar ?</h2>
        <p class="mt-4 text-lg text-white/80">Ne restez pas bloqué sur la route. Demandez une assistance maintenant et soyez mis en relation avec un dépanneur disponible.</p>
        <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-white text-night hover:bg-night-100 font-semibold px-8 py-4 rounded-xl text-lg transition-all hover:scale-[1.02]">Demander une assistance</a>
    </div>
</section>
@endsection
