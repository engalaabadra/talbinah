<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone_no' => ['required','numeric','regex:/^\d+$/','digits_between:7,14',Rule::unique('users')],
            'email' => ['sometimes','max:255',Rule::unique('users')],
            'full_name' => ['required','min:3','max:255'],
            'type' => ['nullable','in:1,0'],
            'password' => 'required|',
            'confirm_password' => 'required|same:password',
        ];
    }
}
