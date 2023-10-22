<?php

namespace App\Http\Requests\HallFormRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreHallRequest extends FormRequest
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
            'name' => 'regex:/^Зал\s[1-9][0-9]?\z/|bail|unique:halls,nameHall',
        ];
    }
}
