<?php
namespace App\Repositories\Auth\Recovery\Password;

use App\Services\MsegatSmsService;
use App\Services\ProccessSendingCodesService;
use App\Traits\GeneralTrait;
use Modules\Auth\Entities\User;

class PasswordRepository  implements PasswordRepositoryInterface{

    use GeneralTrait;

    public function forgotPassword($request,$model){//model: password_resets , model1: user
        $code = "0000";  //TODO::strRandom()
        $result =  $request->processForgotPassword($request,$code,$model);
        return $result;
    }
    public function checkCode($data,$model){
        $resultUser =  User::where(['phone_no'=>$data['phone_no'],'country_id'=>$data['country_id']])->first();
        if(!$resultUser){
            return trans('messages.Invalid credentials');
        }else{

            $user= app(ProccessSendingCodesService::class)->checkCode($model,$data['code'],$resultUser);
            if(is_string($user)) return  $user;
            return $user;
        }

    }
    public function resendCode($data,$code,$model){
        $user = User::where(['phone_no'=>$data['phone_no'],'country_id'=>$data['country_id']])->first();
        if ($user){
            app(ProccessSendingCodesService::class)->insertCode($model,$code,$user);
           
            app(MsegatSmsService::class)->sendResetSms($user->phone_no,$user->country_id,$code);
            return ['code'=>(string)($code),'user'=>$user];
        }

        return trans('messages.your country is wrong , pls enter correct your country');

    }

    public function resetPassword($request){//model :user
        $data=$request->validated();
        $resultUser = $request->has('email') || $request->has('phone_no') ? $this->checkEmailPhone($request) : trans('messages.Pls, enter email or phone');

        if(is_string($resultUser)){
            return $resultUser;
        }else{
            $resultUser->update(['password'=>$data['password']]);
            return $resultUser;
        }
    }
}
