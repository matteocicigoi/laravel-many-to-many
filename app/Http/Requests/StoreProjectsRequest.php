<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectsRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:40', Rule::unique('projects')],
            'slug' => ['max:40', 'nullable'],
            'link' => ['max:255', 'url', 'nullable'],
            'type_id' => ['exists:types,id', 'nullable'],
            'technologies' => ['exists:technologies,id', 'nullable'],
            'image' => ['nullable', 'image']
        ];
    }
}
