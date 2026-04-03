<?php

namespace App\Http\Requests\ActivityLevel;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityLevelRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'unique:activity_levels'],
            'name' => ['required', 'string'],
            'coefficient' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
        ];
    }
}
