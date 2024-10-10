<?php

namespace Modules\ArticleCategory\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StoreArticleCategoryRequest extends FormRequest
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
            'name' => ['required','unique:article_categories'],
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
