<?php

namespace App\Http\Requests\Auth\User;

use App\Models\RegisterCodeNum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Appointment\Entities\Appointment;
use Modules\Profile\Entities\Profile;
use Modules\Wallet\Entities\Wallet;
use ProccessSendingCodesService;
use App\Services\SendingMessagesService;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
                'email' => 'required_if:phone_no,=,null|email|unique:users,email',
                'country_id' => 'required_if:phone_no,!=,null|numeric|exists:countries,id',
                'phone_no' => 'required_if:email,=,null|numeric|regex:/^\d+$/|digits_between:7,14|unique:users,phone_no',
                'code' => 'sometimes',
                'password' => ['required', Rules\Password::defaults()],
                'fcm_token' => ['sometimes'],
        ];
    }

    /**
    * Methods being called.
    *
    * @return object
    */
    public function addRoleUser($user,$roleId){
        return $user->roles()->attach([$roleId]);
    }

    

    /**
    * Registration User In db .
    *
    * @return object
    */
    public function actionRegister($request,$model,$type){//model2:registerCodeNum
            $data=$request->validated();
            if(isset($data['country_id']) && isset($data['phone_no'])){
                $regCode = RegisterCodeNum::where(['phone_no'=>$data['phone_no'],'country_id'=>$data['country_id']])->first();
                if ($regCode) {
                    if ($data['code'] == $regCode->code) {
                        $registered = User::create(['country_id' => $data['country_id'], 'phone_no' => $data['phone_no'], 'password' => $data['password'], 'fcm_token' => $data['fcm_token'], 'phone_verified_at' => now()]);

                    }else{
                        return trans('messages.code is invalid, try again');
                    }

                }else{
                    return trans('messages.data you entered is wrong');
                }

            }elseif(isset($data['email'])){
                    $registered=User::create(['email'=>$data['email'],'password'=>$data['password'],'fcm_token'=>$data['fcm_token']]);
            }
            //create wallet for this user
            $wallet = new Wallet();
            $registered->wallet()->save($wallet);

            $this->addRoleUser($registered,3);//this user has role : user
            
           return $registered;

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

