<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'fat_per' => 'nullable | numeric | between:1,99',
            'weight' => 'nullable | numeric | between:1,200'
        ];
    }
}
