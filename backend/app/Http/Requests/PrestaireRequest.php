<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'          => 'required|string|max:255',
            'prenom'       => 'required|string|max:255',
            'specialite'   => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'disponible'   => 'boolean',
        ];
    }
}
