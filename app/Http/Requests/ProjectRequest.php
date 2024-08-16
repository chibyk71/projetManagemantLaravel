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
        return $this->user()->hasPermissionTo("create projects");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|min:6',
            'contractor' => 'sometimes|string|min:1',
            'start_date' => 'sometimes|string',
            'due_date' => 'sometimes|string',
            'description' => 'sometimes|string',
            'progress' => 'sometimes|numeric|min:0|max:100',
            'assigned' => 'nullable|array',
            'assigned.*' => "numeric", // Ensuring each element in the assigned array is a string
            'project_number' => 'nullable|string',
            'contract_sum' => 'sometimes|string',
            'date_of_award' => 'sometimes|string',
            'duration' => 'sometimes|string',
        ];
    }
}
