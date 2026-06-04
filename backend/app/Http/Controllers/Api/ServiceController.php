<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Service::with(['prestataire', 'categorie'])->get());
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Service::with(['prestataire', 'categorie'])->findOrFail($id));
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $service = Service::create($request->validated());

        return response()->json($service->load(['prestataire', 'categorie']), 201);
    }

    public function update(ServiceRequest $request, string $id): JsonResponse
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());

        return response()->json($service->load(['prestataire', 'categorie']));
    }

    public function destroy(string $id): JsonResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service supprimé']);
    }
}
