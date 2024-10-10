<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'doctor_id' => ['required','numeric','exists:users,id'],
            'user_id' => ['required','numeric','exists:users,id'],
            'date' => ['required' , 'date','date_format:Y-m-d','after:yesterday'],
            'start_time' => ['required'],
            'end_time' => ['required','after:start_time'],
            'day_id' => ['required','numeric','exists:days,id'],
            'communication_id' => ['required','numeric','exists:communications,id'],
            'payment_id' => ['required','numeric','exists:payments,id'],
            'duration_id' => ['required','numeric','exists:durations,id'],
            'full_name' => ['required','max:30'],
            'age' => ['nullable','numeric'],
            'gender' => ['required','in:1,0'],
            'problem' => ['required'],
            'status' => ['required'],
            'finance_attach' => ['sometimes','file','mimes:pdf,docx,jpg,jpeg,png,txt'],
        ];
    }
}
