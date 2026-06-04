<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignalementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avis_id' => 'required|exists:avis,id',
            'motif'   => 'required|string|max:500',
        ];
    }
}
