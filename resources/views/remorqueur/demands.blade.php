@extends('layouts.app')

@section('title', 'Demandes remorqueur')

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <x-icon name="bell" class="w-6 h-6 text-orange-500" />
            Demandes de remorquage
        </h1>

        @if($interventions->isEmpty())
            <div class="card p-12 text-center text-slate-500">
                <x-icon name="bell" class="w-12 h-12 mx-auto mb-3 text-slate-300" />
                <p class="font-medium text-slate-700">Aucune demande disponible</p>
                <p class="text-sm mt-1">Les nouvelles demandes apparaitront ici.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($interventions as $intervention)
                    <div class="card p-5">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    @if($intervention->client_photo)
                                        <img src="{{ asset('storage/' . $intervention->client_photo) }}" alt="" class="w-12 h-12 rounded-full object-cover bg-slate-100">
                                    @else
                                        @php $clientInitials = collect(preg_split('/\s+/', trim($intervention->client_name ?? 'Client sans compte')))->map(fn ($w) => strtoupper(mb_substr($w, 0, 1)))->take(2)->implode(''); @endphp
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-orange-100 text-orange-600 font-semibold">{{ $clientInitials ?: '?' }}</div>
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <p class="font-semibold text-slate-900">{{ ucfirst($intervention->service_type) }}</p>
                                    <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                        <x-icon name="map-pin" class="w-4 h-4 text-slate-400" />
                                        {{ $intervention->destination }}
                                    </p>
                                    <p class="flex items-center gap-1.5 text-sm text-slate-500">
                                        <x-icon name="user" class="w-4 h-4 text-slate-400" />
                                        {{ $intervention->client_name }}
                                    </p>
                                    @php
                                        $cPhone = preg_replace('/[^0-9]/', '', $intervention->client_phone ?? '');
                                        $cWhatsapp = $cPhone ? 'https://wa.me/221' . preg_replace('/^221/', '', $cPhone) : '#';
                                    @endphp
                                    <p class="flex items-center gap-1.5 text-sm text-slate-600">
                                        <x-icon name="phone" class="w-4 h-4 text-slate-400" />
                                        @if($intervention->client_phone)
                                            <a href="tel:{{ $intervention->client_phone }}" class="hover:text-orange-600">{{ $intervention->client_phone }}</a>
                                        @else
                                            <span class="text-slate-400">Numero non renseigne</span>
                                        @endif
                                    </p>
                                    @if($intervention->photo)
                                        <a href="{{ asset('storage/' . $intervention->photo) }}" target="_blank" rel="noopener" class="block mt-2">
                                            <img src="{{ asset('storage/' . $intervention->photo) }}" alt="Photo de la panne" class="w-28 h-28 object-cover rounded-lg border border-slate-200">
                                        </a>
                                    @endif
                                    <div class="flex gap-2 pt-1">
                                        <a href="tel:{{ $intervention->client_phone }}" class="btn-secondary px-3 py-1 text-xs {{ $intervention->client_phone ? '' : 'pointer-events-none opacity-50' }}">
                                            <x-icon name="phone" class="w-3.5 h-3.5" />
                                            Appeler
                                        </a>
                                        <a href="{{ $cWhatsapp }}" target="_blank" rel="noopener" class="px-3 py-1 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 inline-flex items-center gap-1.5 {{ $intervention->client_phone ? '' : 'pointer-events-none opacity-50' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.16c-.24.69-1.4 1.32-1.94 1.36-.52.04-1.18.19-3.97-.82-3.34-1.22-5.44-4.4-5.6-4.6-.16-.2-1.34-1.78-1.34-3.4 0-1.62.85-2.41 1.15-2.74.3-.33.66-.41.87-.41.22 0 .44 0 .63.01.2.01.47-.08.74.56.27.65 1.28 3.02 1.35 3.24.07.22.12.48-.07.75-.19.27-.29.44-.57.67-.29.24-.61.53-.87.72-.29.24-.59.5-.25.98.34.48 1.5 2.47 3.22 3.99 2.21 1.97 4.07 2.5 4.64 2.68.57.18.9.15 1.23-.09.33-.24.1.53.31-.53z"/></svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                    <p class="flex items-center gap-1.5 text-xs text-slate-400">
                                        <x-icon name="clock" class="w-3.5 h-3.5" />
                                        {{ $intervention->created_at->diffForHumans() }}
                                    </p>
                                    @if($intervention->target_professional_id === Auth::id())
                                        <p class="flex items-center gap-1.5 text-xs font-medium text-orange-600">
                                            <x-icon name="zap" class="w-3.5 h-3.5" />
                                            Demande ciblee pour vous
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-2 sm:flex-col">
                                <form method="POST" action="{{ route('remorqueur.intervention.accept', $intervention) }}" class="flex-1" onsubmit="var b=this.querySelector('button'); b.disabled = true; b.classList.add('opacity-50');">
                                    @csrf
                                    <button type="submit" class="btn-primary w-full py-2 text-sm">
                                        <x-icon name="check" class="w-4 h-4" />
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('remorqueur.intervention.reject', $intervention) }}" class="flex-1"
                                    onsubmit="if(!confirm('Confirmer le refus de cette demande ?')) return false; var b=this.querySelector('button'); b.disabled = true; b.classList.add('opacity-50');">
                                    @csrf
                                    <input type="hidden" name="reason" value="Refuse par le remorqueur">
                                    <button type="submit" class="btn-secondary w-full py-2 text-sm">
                                        <x-icon name="x" class="w-4 h-4" />
                                        Refuser
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
