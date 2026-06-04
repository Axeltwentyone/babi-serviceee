<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reservation_id' => 'required|exists:reservations,id',
            'note'           => 'required|integer|min:1|max:5',
            'commentaire'    => 'required|string|max:1000',
        ];
    }
}
