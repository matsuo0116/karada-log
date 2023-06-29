<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            'comment' => 'nullable | max:255',
            '' => 'nullable | numeric | between:1,99',
            'log.*.weight' => 'nullable | numeric | between:0,500',
            'log.*.count' => 'nullable | numeric | between:1,100',
            'log.*.sets' => 'nullable | numeric | between:1,20',
            'exercise.*.time' => 'nullable | numeric | between:1,300',
            'exercise.*.distance' => 'nullable | numeric | between:1,99',
        ];
    }
}
