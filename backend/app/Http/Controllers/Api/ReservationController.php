<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function index(): JsonResponse
    {
        $reservations = Reservation::with(['service.prestataire', 'avis'])
            ->where('utilisateur_id', auth()->id())
            ->get();

        return response()->json($reservations);
    }

    public function show(string $id): JsonResponse
    {
        $reservation = Reservation::with(['service.prestataire', 'avis'])
            ->where('utilisateur_id', auth()->id())
            ->findOrFail($id);

        return response()->json($reservation);
    }

    public function store(ReservationRequest $request): JsonResponse
    {
        $reservation = Reservation::create([
            'utilisateur_id'    => auth()->id(),
            'service_id'        => $request->service_id,
            'date_reservation'  => $request->date_reservation,
            'heure_reservation' => $request->heure_reservation,
            'statut'            => 'en_attente',
        ]);

        return response()->json($reservation->load('service.prestataire'), 201);
    }

    public function update(ReservationRequest $request, string $id): JsonResponse
    {
        $reservation = Reservation::where('utilisateur_id', auth()->id())->findOrFail($id);
        $reservation->update($request->validated());

        return response()->json($reservation);
    }

    public function destroy(string $id): JsonResponse
    {
        $reservation = Reservation::where('utilisateur_id', auth()->id())->findOrFail($id);
        $reservation->update(['statut' => 'annulee']);

        return response()->json(['message' => 'Réservation annulée']);
    }
}
