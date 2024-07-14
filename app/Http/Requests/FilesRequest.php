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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "stage" => ['required',"in:BEFORE,DURING,COMPLETE"],
            "names" => "required|array",
            "names.*"=> ["required","regex:/^[a-zA-Z0-9_.]+$/"],
            "folder" => "required|regex:/([a-zA-Z0-9_.\s]+)$/"
        ];
    }

    // public function messages(): array {
    //     return [
    //         "names.*.regex" => "The :attribute must only contain letters, numbers, and underscores."
    //     ];
    // }
}