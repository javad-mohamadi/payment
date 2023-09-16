<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
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
            'mobile'   => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|exists:users,mobile',
            'password' => 'required|min:4|max:30',
        ];
    }

}
