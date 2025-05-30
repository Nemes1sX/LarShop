<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'fullname' => ['required', 'min:3'],
            'email' => ['required', 'email', 'string'],
            'postcode' => ['required', 'string'],
            'address' => ['required', 'min:4'],
            'city' => ['required', 'min:4'],
            'terms' => ['accepted']
        ];
    }
}
