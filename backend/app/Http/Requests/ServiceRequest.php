<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prestataire_id' => 'required|exists:prestataires,id',
            'categorie_id'   => 'required|exists:categories,id',
            'nom'            => 'required|string|max:255',
            'description'    => 'nullable|string',
            'tarif'          => 'required|numeric|min:0',
            'disponibilite'  => 'boolean',
        ];
    }
}
