<?php

namespace Modules\Article\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StoreArticleRequest extends FormRequest
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
            'article_category_id' => ['required','numeric','exists:article_categories,id'],
            'title' => ['required','unique:articles'],
            'description' => ['required','max:3000'],
            'image'=>['mimes:jpeg,bmp,png,gif, svg']
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
