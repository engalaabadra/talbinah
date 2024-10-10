<?php

namespace Modules\Article\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteArticleRequest.
 */
class DeleteArticleRequest extends FormRequest
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
        ];
    }
}
