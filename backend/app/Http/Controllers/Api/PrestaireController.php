<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrestaireRequest;
use App\Models\Prestataire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrestaireController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Prestataire::with('services.categorie');

        if ($request->has('specialite')) {
            $query->where('specialite', 'like', '%' . $request->specialite . '%');
        }

        if ($request->has('disponible')) {
            $query->where('disponible', true);
        }

        return response()->json($query->get());
    }

    public function show(string $id): JsonResponse
    {
        $prestataire = Prestataire::with(['services.categorie'])->findOrFail($id);

        return response()->json($prestataire);
    }

    public function store(PrestaireRequest $request): JsonResponse
    {
        $prestataire = Prestataire::create($request->validated());

        return response()->json($prestataire, 201);
    }

    public function update(PrestaireRequest $request, string $id): JsonResponse
    {
        $prestataire = Prestataire::findOrFail($id);
        $prestataire->update($request->validated());

        return response()->json($prestataire);
    }

    public function destroy(string $id): JsonResponse
    {
        $prestataire = Prestataire::findOrFail($id);
        $prestataire->delete();

        return response()->json(['message' => 'Prestataire supprimé']);
    }
}
