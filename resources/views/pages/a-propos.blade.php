@extends('layouts.app')
@section('title', 'À propos')
@section('content')
<x-page-hero
    title="À propos de SamaRemorque"
    subtitle="Une plateforme sénégalaise conçue pour rendre l'assistance routière plus simple et plus transparente."
    eyebrow="Notre histoire"
/>

<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Notre mission</h2>
                <p class="mt-5 text-slate-600 leading-relaxed text-lg">En cas de panne, il est souvent difficile de trouver rapidement un professionnel de confiance, au bon prix et près de soi.</p>
                <p class="mt-4 text-slate-600 leading-relaxed">SamaRemorque connecte les conducteurs avec des remorqueurs et dépanneurs vérifiés, disponibles en temps réel — une assistance plus humaine, transparente et accessible au Sénégal.</p>
            </div>
            <div class="landing-media-frame landing-media-frame--light">
                <img src="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}" alt="SamaRemorque" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-20 md:py-28 bg-night-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-night tracking-tight">Nos engagements</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['title' => 'Professionnels vérifiés', 'desc' => 'Chaque remorqueur et dépanneur est validé par notre équipe.'],
                ['title' => 'Transparence', 'desc' => 'Les tarifs sont affichés. Pas de surprise.'],
                ['title' => 'Suivi en temps réel', 'desc' => 'Suivez l\'arrivée du professionnel sur la carte.']
            ] as $index => $item)
            <div>
                <span class="font-display text-5xl font-bold text-accent-500/20">0{{ $index + 1 }}</span>
                <h3 class="mt-2 font-display text-xl font-semibold text-night">{{ $item['title'] }}</h3>
                <p class="mt-2 text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 md:py-28 bg-night text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold tracking-tight">Prêt à essayer ?</h2>
        <p class="mt-4 text-white/65 text-lg">Demandez une assistance ou inscrivez-vous en tant que professionnel.</p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
            <a href="{{ route('guest.create') }}" class="landing-cta-primary">Demander une assistance</a>
            <a href="{{ route('register') }}" class="landing-cta-ghost">Devenir professionnel</a>
        </div>
    </div>
</section>
@endsection
