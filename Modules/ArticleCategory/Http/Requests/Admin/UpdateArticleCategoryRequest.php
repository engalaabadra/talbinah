<?php

namespace Modules\ArticleCategory\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateArticleCategoryRequest.
 */
class UpdateArticleCategoryRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the ArticleCategory is authorized to make this request.
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
            'time_id' => ['required','numeric','exists:times,id'],
            'date' => ['required' , 'date','date_format:Y-m-d','after:yesterday'],
            
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
