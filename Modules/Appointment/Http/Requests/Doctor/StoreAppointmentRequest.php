<?php

namespace Modules\Appointment\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StoreAppointmentRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Appointment is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Store Appointment for only doctor        
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
            'day_id' => ['required','numeric','exists:days,id'],
            // 'duration_id' => ['required','numeric','exists:durations,id'],
            'start_time' => ['required','date_format:H:i','before:end_time'],
            'end_time' => ['required','date_format:H:i','different:start_time','after:start_time']
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'start_time.required' => 'حقل وقت البدء مطلوب.',
            'start_time.date_format' => 'يجب ان تكون صيغة وقت البدء (ساعة:دقيقة)',
            'start_time.before' => 'وقت البدء يجب أن يكون قبل وقت الانتهاء.',
            'end_time.required' => 'حقل وقت الانتهاء مطلوب.',
            'end_time.date_format' => 'يجب ان تكون صيغة وقت الانتهاء (ساعة:دقيقة)',
            'end_time.different' => 'وقت الانتهاء يجب أن يكون مختلفًا عن وقت البدء.',
            'end_time.after' => 'وقت الانتهاء يجب أن يكون بعد وقت البدء.',
        ];
    }
}
