@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-900">Notifications</h1>
            <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                @csrf
                <button type="submit" class="text-sm text-orange-600 hover:text-orange-500">Tout marquer comme lu</button>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-slate-200">
                @forelse($notifications as $notification)
                    <li class="{{ is_null($notification->read_at) ? 'bg-orange-50' : 'bg-white' }}">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-orange-600">{{ $notification->data['title'] ?? $notification->type }}</p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    @if(is_null($notification->read_at))
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Non lu</p>
                                    @else
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Lu</p>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-slate-600">{{ $notification->data['body'] ?? '' }}</p>
                            <div class="mt-2 flex justify-between items-center">
                                <p class="text-sm text-slate-500">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
                                @if(is_null($notification->read_at))
                                    <form method="POST" action="{{ route('notifications.read', $notification) }}">
                                        @csrf
                                        <button type="submit" class="text-sm text-orange-600 hover:text-orange-500">Marquer comme lu</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-4 py-6 text-center text-slate-500">Aucune notification.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
