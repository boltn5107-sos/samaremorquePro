@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<x-page-hero
    title="Contact"
    subtitle="Une question ou une suggestion ? L'équipe SamaRemorque vous répond."
    eyebrow="Support"
/>

<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            <div>
                <h2 class="font-display text-2xl md:text-3xl font-bold text-night tracking-tight">Nos coordonnées</h2>
                <div class="mt-8 space-y-4">
                    <a href="tel:+221774467596" class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-accent-300 hover:bg-accent-50/50 transition-all group">
                        <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-accent-100 text-accent-600 flex items-center justify-center group-hover:bg-accent-500 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <span class="font-medium text-night">+221 77 446 75 96</span>
                    </a>
                    <a href="tel:+221708981888" class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-accent-300 hover:bg-accent-50/50 transition-all group">
                        <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <span class="font-medium text-night">+221 70 898 18 88</span>
                    </a>
                    <a href="https://wa.me/221774467596" target="_blank" rel="noopener" class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-emerald-300 hover:bg-emerald-50/50 transition-all group">
                        <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2z"/></svg>
                        </span>
                        <span class="font-medium text-night">WhatsApp</span>
                    </a>
                </div>
            </div>
            <div>
                <h2 class="font-display text-2xl md:text-3xl font-bold text-night tracking-tight">Envoyez un message</h2>
                <form class="mt-8 space-y-5" onsubmit="event.preventDefault(); if(window.showToast){showToast('Message envoyé !','success');} else {alert('Message envoyé avec succès !');}">
                    <div>
                        <label for="contact_name" class="label">Nom</label>
                        <input type="text" id="contact_name" class="input" placeholder="Votre nom" required>
                    </div>
                    <div>
                        <label for="contact_email" class="label">Email</label>
                        <input type="email" id="contact_email" class="input" placeholder="votre@email.com" required>
                    </div>
                    <div>
                        <label for="contact_message" class="label">Message</label>
                        <textarea id="contact_message" rows="4" class="input" placeholder="Votre message" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full text-base py-3.5">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
