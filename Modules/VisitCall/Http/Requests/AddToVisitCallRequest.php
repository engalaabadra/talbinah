<?php

namespace Modules\VisitCall\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class AddToVisitCallRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the VisitCall is authorized to make this request.
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
            'reservation_id' => ['numeric','exists:reservations,id','required'],
          //  'type' => ['required','in:visit_call'],
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
