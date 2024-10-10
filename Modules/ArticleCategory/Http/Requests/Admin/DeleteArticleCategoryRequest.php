<?php

namespace Modules\ArticleCategory\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteArticleCategoryRequest.
 */
class DeleteArticleCategoryRequest extends FormRequest
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
        ];
    }
}
