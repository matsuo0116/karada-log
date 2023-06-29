<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'image' => 'nullable | max:2000 | mimes: jpg,jpeg,png,gif',
            'age' => ' nullable | integer | between:0,100',
            'height' => 'nullable | numeric | between:0,250',
            'target_fat' => 'nullable | numeric | between:0,99',
            'target_weight' => 'nullable | numeric | between:0,200',
            'email' => '|email:filter,dns|max:255',
        ];
    }
}
