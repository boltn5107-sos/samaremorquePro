<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminInterventionController extends Controller
{
    public function index(Request $request)
    {
        $query = Intervention::with('client', 'professional')
            ->orderByDesc('created_at');

        if ($request->filled('status') && array_key_exists($request->status, Intervention::STATUS_LABELS)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('destination', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_phone', 'like', "%{$search}%")
                    ->orWhere('tracking_code', 'like', "%{$search}%")
                    ->orWhere('vehicle_type', 'like', "%{$search}%")
                    ->orWhereHas('client', fn ($c) => $c->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%"));
            });
        }

        $interventions = $query->paginate(20)->withQueryString();

        $statusCounts = Intervention::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        return view('admin.interventions', compact('interventions', 'statusCounts'));
    }

    public function show(Intervention $intervention)
    {
        $intervention->load('client', 'professional', 'statuses', 'vehicle');

        return view('admin.intervention-detail', compact('intervention'));
    }

    public function destroy(Intervention $intervention)
    {
        $photo = $intervention->photo;

        $intervention->statuses()->delete();
        $intervention->notifications()->delete();
        $intervention->rejections()->delete();
        $intervention->delete();

        if ($photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($photo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($photo);
        }

        return redirect()->route('admin.intervention.index')
            ->with('status', 'Intervention supprimee.');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $query = Intervention::with('client', 'professional');

        if ($request->filled('status') && array_key_exists($request->status, Intervention::STATUS_LABELS)) {
            $query->where('status', $request->status);
        }

        $interventions = $query->orderByDesc('created_at')->get();

        $filename = 'interventions_' . date('Y-m-d_His') . '.csv';

        $columns = [
            'ID', 'Code de suivi', 'Service', 'Statut', 'Client', 'Client tel', 'Professionnel', 'Destination', 'Distance (km)',
            'Ville depart env.', 'Detail', 'Cree le', 'Termine le', 'Note',
        ];

        return response()->streamDownload(function () use ($interventions, $columns) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF"); // BOM UTF-8
            fputcsv($handle, $columns);
            foreach ($interventions as $i) {
                $lastStatus = $i->statuses()->orderByDesc('created_at')->first();
                fputcsv($handle, [
                    $i->id,
                    $i->tracking_code,
                    ucfirst($i->service_type),
                    $i->status_label,
                    $i->client_name,
                    $i->client_phone ?? '-',
                    $i->professional?->full_name ?? '-',
                    $i->destination,
                    $i->distance_km,
                    $i->client_address,
                    $i->description,
                    $i->created_at->format('d/m/Y H:i'),
                    $lastStatus && in_array($i->status, ['intervention_terminee', 'annulee']) ? $lastStatus->created_at->format('d/m/Y H:i') : '-',
                    $i->rating ?? '-',
                ]);
            }
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
