<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'mobile'    => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|exists:users,mobile',
            'password' => 'required|min:6|max:30',
        ];
    }

}
