<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:6',
            'contractor' => 'required|string|min:1',
            'start_date' => 'required|string',
            'due_date' => 'required|string',
            'desc' => 'required|string',
            'progress' => 'required|numeric|min:0|max:100',
            'assigned' => 'nullable|array',
            'assigned.*' => 'number', // Ensuring each element in the assigned array is a string
            'number' => 'nullable|string',
            'contract_sum' => 'required|string',
            'date_of_award' => 'required|string',
            'duration' => 'required|string',
        ];
    }
}
