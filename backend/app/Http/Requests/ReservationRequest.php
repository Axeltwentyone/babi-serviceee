<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id'       => 'required|exists:services,id',
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_reservation' => 'required|date_format:H:i',
        ];
    }
}
