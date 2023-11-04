<?php

namespace App\Http\Requests\HallFormRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreShemeHallRequest extends FormRequest
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
            '*_r' => ['required', 'max:2'],
            '*_c' => ['required', 'max:2'],
        ];
    }
}
