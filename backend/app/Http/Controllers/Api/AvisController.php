<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvisRequest;
use App\Models\Avis;
use Illuminate\Http\JsonResponse;

class AvisController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Avis::with(['utilisateur', 'reservation.service.prestataire'])
                ->where('utilisateur_id', auth()->id())
                ->get()
        );
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Avis::with(['utilisateur', 'reservation'])->findOrFail($id));
    }

    public function store(AvisRequest $request): JsonResponse
    {
        $avis = Avis::create([
            'utilisateur_id' => auth()->id(),
            'reservation_id' => $request->reservation_id,
            'note'           => $request->note,
            'commentaire'    => $request->commentaire,
        ]);

        return response()->json($avis, 201);
    }

    public function update(AvisRequest $request, string $id): JsonResponse
    {
        $avis = Avis::where('utilisateur_id', auth()->id())->findOrFail($id);
        $avis->update($request->validated());

        return response()->json($avis);
    }

    public function destroy(string $id): JsonResponse
    {
        $avis = Avis::where('utilisateur_id', auth()->id())->findOrFail($id);
        $avis->delete();

        return response()->json(['message' => 'Avis supprimé']);
    }
}
