<?php

namespace Modules\Reservation\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class AddReservationRequest extends FormRequest
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
            'doctor_id' => ['required','numeric','exists:users,id'],
            'day_id' => ['required','numeric','exists:days,id'],
            'date' => ['required' , 'date','date_format:Y-m-d','after:yesterday'],
            'start_time' => ['required','date_format:H:i'],
            'end_time' => ['required','date_format:H:i'],
            'communication_id' => ['required','numeric','exists:communications,id'],
            'payment_id' => ['required','numeric','exists:payments,id'],
            'duration_id' => ['required','numeric','exists:durations,id'],
            'full_name' => ['required','max:30'],
            'age' => ['nullable','numeric'],
            'gender' => ['required','in:1,0'],
            'problem' => ['required'],

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
