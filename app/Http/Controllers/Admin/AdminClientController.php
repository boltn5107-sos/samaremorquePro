<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.clients', compact('clients'));
    }

    public function show(User $client)
    {
        abort_if($client->role !== 'client', 404);

        $client->load('vehicles', 'interventionsAsClient');

        return view('admin.client-detail', compact('client'));
    }

    public function suspend(Request $request, User $client)
    {
        abort_if($client->role !== 'client', 404);

        $client->update(['is_active' => false]);

        return back()->with('status', 'client-suspended');
    }

    public function reactivate(Request $request, User $client)
    {
        abort_if($client->role !== 'client', 404);

        $client->update(['is_active' => true]);

        return back()->with('status', 'client-reactivated');
    }

    public function destroy(Request $request, User $client)
    {
        abort_if($client->role !== 'client', 404);

        foreach ($client->interventionsAsClient as $intervention) {
            $intervention->statuses()->delete();
            $intervention->notifications()->delete();
            $intervention->rejections()->delete();
            $intervention->delete();
        }

        $client->vehicles()->delete();
        $client->clientProfile?->delete();
        $client->locations()->delete();
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('status', 'Client supprime.');
    }
}
