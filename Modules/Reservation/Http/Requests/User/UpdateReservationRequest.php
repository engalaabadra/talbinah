<?php

namespace Modules\Reservation\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class UpdateReservationRequest extends FormRequest
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
        // $this = $this->except('id');

        return [
            // 'doctor_id' => ['required','numeric','exists:users,id'],
            'day_id' => ['required','numeric','exists:days,id'],
            'date' => ['required' , 'date','date_format:Y-m-d','after:yesterday'],
            'start_time' => ['required','date_format:H:i'],
            'end_time' => ['required','date_format:H:i'],
            // 'duration_id' => ['required','numeric','exists:durations,id'],
            'reason_id' => ['nullable','exists:reasons_rescheduling,id'],
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
