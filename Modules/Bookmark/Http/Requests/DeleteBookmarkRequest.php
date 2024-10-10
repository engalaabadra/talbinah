<?php

namespace Modules\Bookmark\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteBookmarkRequest.
 */
class DeleteBookmarkRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Bookmark is authorized to make this request.
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
            'article_id' => ['numeric','exists:articles,id','required'],

        ];
    }
}
