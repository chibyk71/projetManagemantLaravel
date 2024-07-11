<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("create");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "stage" => ['required', function ($attribute, $value, $fail) {
                $validStages = ['BEFORE', 'DURING', 'COMPLETE'];
                if (!in_array($value, $validStages)) {
                    return $fail('The ' . $attribute . ' must be one of the following values: BEFORE, DURING, COMPLETE.');
                }
            }],
            "names.*"=> ["required","regex:/^[a-zA-Z0-9_.]+$/"],
            "folder" => "required|alpha_dash"
        ];
    }

    public function messages(): array {
        return [
            "name.regex" => "The :attribute must only contain letters, numbers, and underscores."
        ];
    }
}