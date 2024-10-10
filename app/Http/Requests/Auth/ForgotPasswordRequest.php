<?php

namespace App\Http\Requests\Auth;

use App\Services\MsegatSmsService;
use App\Services\ProccessSendingCodesService;
use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;
/**
 * Class ForgotPasswordRequest.
 */
class ForgotPasswordRequest extends FormRequest
{
    use GeneralTrait;

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
            'phone_no' => 'required|numeric|regex:/^\d+$/|digits_between:7,14|exists:users,phone_no',
            'country_id' => ['required_if:phone_no,!=,null'],
        ];
    }
    /**
     * Process Forgot Password.
     *
     * @return array
     */
    public function processForgotPassword($data,$code,$model){//model :reset_passd
        $user = User::where(['phone_no'=>$data['phone_no'],'country_id'=>$data['country_id']])->first();
        if ($user){

                app(ProccessSendingCodesService::class)->insertCode($model,$code,$user);

                app(MsegatSmsService::class)->sendResetSms($user->phone_no,$user->country_id,$code);
            return ['code'=>(string)($code),'user'=>$user];
        }

         return trans('messages.your country is wrong , pls enter correct your country');
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
