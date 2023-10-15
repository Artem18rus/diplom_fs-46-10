<?php

namespace App\Http\Requests\HallFormRequest;

use Illuminate\Foundation\Http\FormRequest;

class EditHallRequest extends FormRequest
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
        $row = "/^[1-9][0-9]?.[r]/";
        $char = "/^[1-9][0-9]?.[c]/";
        return [
            "$row" => ['string'],
            "$char" => ['string'],
            // 'row' => 'required',
        ];
    }
}
