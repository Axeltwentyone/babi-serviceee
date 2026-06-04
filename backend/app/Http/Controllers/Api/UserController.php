<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Utilisateur::all());
    }

    public function destroy(string $id): JsonResponse
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return response()->json(['message' => 'Utilisateur supprimé']);
    }
}
