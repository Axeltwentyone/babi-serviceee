<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignalementRequest;
use App\Models\Signalement;
use Illuminate\Http\JsonResponse;

class SignalementController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Signalement::with(['avis', 'utilisateur'])->get()
        );
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Signalement::with(['avis', 'utilisateur'])->findOrFail($id));
    }

    public function store(SignalementRequest $request): JsonResponse
    {
        $signalement = Signalement::create([
            'utilisateur_id' => auth()->id(),
            'avis_id'        => $request->avis_id,
            'motif'          => $request->motif,
        ]);

        return response()->json($signalement, 201);
    }

    public function update(SignalementRequest $request, string $id): JsonResponse
    {
        $signalement = Signalement::findOrFail($id);
        $signalement->update($request->validated());

        return response()->json($signalement);
    }

    public function destroy(string $id): JsonResponse
    {
        $signalement = Signalement::findOrFail($id);
        $signalement->delete();

        return response()->json(['message' => 'Signalement supprimé']);
    }
}
