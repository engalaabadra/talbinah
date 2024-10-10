<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;


/**
 * Class ResendCodeRequest.
 */
class ResendCodeRequest extends FormRequest
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
            'phone_no' => 'required|numeric|regex:/^\d+$/|digits_between:7,14|exists:users,phone_no',
            'country_id' => ['required_if:phone_no,!=,null'],
        ];
    }
    /**
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }



}
