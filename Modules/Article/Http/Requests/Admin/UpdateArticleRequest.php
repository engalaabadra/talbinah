<?php

namespace Modules\Article\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateArticleRequest.
 */
class UpdateArticleRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Article is authorized to make this request.
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
            'title' => ['max:225'],
            'description' => ['nullable'],
            'image'=>['nullable','mimes:jpeg,bmp,png,gif,svg']
           
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
