<?php

namespace Modules\Keyword\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateKeywordRequest.
 */
class UpdateKeywordRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Keyword is authorized to make this request.
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
