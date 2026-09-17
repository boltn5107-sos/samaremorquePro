@extends('layouts.app')
@section('title', 'Guide depannage Dakar - SamaRemorque | Conseils et bons reflexes en cas de panne')
@section('content')
    <header class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/remorque_qui_transporte_un_vehicule.jpg') }}" alt="Guide depannage Dakar" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <h1 class="text-4xl font-extrabold tracking-tight">Guide depannage Dakar</h1>
            <p class="mt-4 text-lg text-slate-300 max-w-2xl">Les bons reflexes a avoir en cas de panne et les conseils pour choisir un depanneur fiable a Dakar, Pikine et Rufisque.</p>
        </div>
    </section>

    <section class="relative overflow-hidden reveal py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-slate-900">Que faire en cas de panne ?</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Mettez-vous en securite</h3>
                    <p class="mt-2 text-sm text-slate-600">Garez-vous sur le cote, allumez les feux de detresse et placez le triangle de signalisation a environ 30 metres.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Appelez un professionnel</h3>
                    <p class="mt-2 text-sm text-slate-600">Contactez un depanneur ou un remorqueur. Utilisez SamaRemorque pour trouver un professionnel verifie pres de vous.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivez l'intervention</h3>
                    <p class="mt-2 text-sm text-slate-600">Suivez l'arrivee du depanneur sur la carte et soyez informe a chaque etape jusqu'a la fin de l'intervention.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden reveal py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-slate-900">Conseils pour choisir un depanneur</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">1</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Verifiez les credentials</h3>
                    <p class="mt-2 text-sm text-slate-600">Choisissez un depanneur verifie avec des evaluations positives et un tarif horaire clair.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">2</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Demandez un devis</h3>
                    <p class="mt-2 text-sm text-slate-600">Demandez un devis avant l'intervention pour eviter les mauvaises surprises sur le prix.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl font-bold">3</div>
                    <h3 class="mt-5 text-lg font-semibold text-slate-900">Suivez en temps reel</h3>
                    <p class="mt-2 text-sm text-slate-600">Utilisez une application avec suivi GPS pour voir l'arrivee du depanneur en temps reel.</p>
                </div>
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('guest.create') }}" class="btn-primary text-base px-8 py-3.5">Demander une assistance</a>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden reveal py-16 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold">En panne a Dakar ?</h2>
            <p class="mt-3 text-slate-300 text-lg">Ne restez pas bloque. Demandez une assistance maintenant et soyez mis en relation avec un depanneur disponible.</p>
            <a href="{{ route('guest.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base">Demander une assistance</a>
        </div>
    </section>
@endsection