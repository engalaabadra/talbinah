<?php

namespace Modules\Reservation\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class DeleteReservationRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Reservation is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Store Reservation for only user        
        $authorizeRes= $this->authorizeRole(['user']);
        if($authorizeRes==true){
            return true;
        }else{
            return failedAuthorization();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason_id' => ['nullable','exists:reasons_cancelation,id'],
            'reason' => ['max:2000'],
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
