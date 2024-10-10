<?php

namespace Modules\Specialty\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateSpecialtyRequest.
 */
class UpdateSpecialtyRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Specialty is authorized to make this request.
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
            
            'description' => [Rule::unique('specialties')->ignore($this->id),'max:1000'],
            'name' => [Rule::unique('specialties')->ignore($this->id)],
            'image'=>['required','mimes:jpeg,bmp,png,gif, svg'],
            'active' => ['sometimes',  'in:1,0'],
        
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
