<?php

namespace Modules\Appointment\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteAppointmentRequest.
 */
class DeleteAppointmentRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Appointment is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Delete user for only doctor
        $authorizeRes= $this->authorizeRole(['doctor']);
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
        ];
    }
}
