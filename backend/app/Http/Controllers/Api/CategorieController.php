<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;

class CategorieController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Categorie::all());
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Categorie::with('services')->findOrFail($id));
    }

    public function store(CategorieRequest $request): JsonResponse
    {
        $categorie = Categorie::create($request->validated());

        return response()->json($categorie, 201);
    }

    public function update(CategorieRequest $request, string $id): JsonResponse
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->validated());

        return response()->json($categorie);
    }

    public function destroy(string $id): JsonResponse
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée']);
    }
}
