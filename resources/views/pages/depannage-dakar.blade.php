@extends('layouts.app')
@section('title', 'Dépannage Dakar')
@section('meta_description', 'Dépannage à Dakar : trouvez un dépanneur ou remorqueur vérifié. Intervention rapide 24/7 à Dakar, Pikine et Rufisque.')
@section('content')
<x-page-hero
    title="Dépannage à Dakar : un pro près de vous"
    subtitle="Batterie à plat, crevaison, panne moteur — trouvez un dépanneur ou remorqueur vérifié à Dakar, Pikine et Rufisque."
    eyebrow="Dépannage Dakar"
>
    <x-slot:actions>
        <a href="{{ route('guest.create') }}" class="landing-cta-primary">Demander une assistance</a>
        <a href="#services" class="landing-cta-ghost">Voir les services</a>
    </x-slot:actions>
</x-page-hero>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Pourquoi SamaRemorque ?</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['title' => 'Dépanneurs vérifiés', 'desc' => 'Profil, tarif et évaluation visibles avant de choisir.'],
                ['title' => 'Intervention rapide', 'desc' => 'Mise en relation en quelques minutes, suivi sur la carte.'],
                ['title' => 'Tarifs transparents', 'desc' => 'Vous connaissez le coût avant de confirmer.']
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
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Services à Dakar</h2>
        <p class="mt-3 text-lg text-slate-500 max-w-2xl">Interventions pour tous types de pannes à Dakar, Pikine et Rufisque.</p>
        <div class="mt-12 divide-y divide-slate-200 border-y border-slate-200">
            @foreach([
                ['title' => 'Dépannage batterie', 'desc' => 'Batterie à plat ou démarrage difficile : intervention sur place.'],
                ['title' => 'Dépannage crevaison', 'desc' => 'Remplacement ou réparation de pneu sur votre position.'],
                ['title' => 'Remorquage Dakar', 'desc' => 'Transport sécurisé vers le garage de votre choix.']
            ] as $i => $service)
            <div class="py-8 md:py-10 flex flex-col md:flex-row md:items-baseline gap-3 md:gap-12">
                <span class="font-display text-sm font-semibold text-accent-500 tracking-widest uppercase w-12">0{{ $i + 1 }}</span>
                <h3 class="font-display text-2xl font-semibold text-night md:w-72 shrink-0">{{ $service['title'] }}</h3>
                <p class="text-slate-600 leading-relaxed max-w-xl">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
        <div class="mt-12">
            <a href="{{ route('guest.create') }}" class="landing-cta-primary !inline-flex">Demander un dépannage</a>
        </div>
    </div>
</section>

<section class="landing-cta-band relative py-20 md:py-28 overflow-hidden">
    <div class="relative max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white tracking-tight">En panne à Dakar ?</h2>
        <p class="mt-4 text-lg text-white/80">Ne restez pas bloqué. Demandez une assistance maintenant.</p>
        <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-white text-night hover:bg-night-100 font-semibold px-8 py-4 rounded-xl text-lg transition-all hover:scale-[1.02]">Demander une assistance</a>
    </div>
</section>
@endsection
