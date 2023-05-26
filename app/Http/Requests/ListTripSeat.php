<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListTripSeat extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'source' => 'required|string|max:20',
            'destination' => 'required|string|max:20',
        ];
    }
}
