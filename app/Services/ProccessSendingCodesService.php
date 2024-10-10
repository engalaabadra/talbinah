<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\User;
use App\Providers\RouteServiceProvider;
use App\Mail\SendingCode;
use Nexmo\Laravel\Facade\Nexmo;

class ProccessSendingCodesService{
    public function conditionEmailPhone($model,$code,$user){
        $this->insertCode($model,$code,$user);
    }
    public function insertCode($model,$code,$user){
        //Check if user has a record in ResetPassword table
        $existingRecord = $model->where('phone_no', $user->phone_no)
            ->first();

        if (!$existingRecord) {
            // If no matching records found, create a new record
            $model->create([
                'code' => $code,
                'country_id' => $user->country_id,
                'phone_no' => $user->phone_no,
            ]);
        } else {
            // If matching records found, update the existing record
            DB::table('password_resets')->where(['phone_no' => $user->phone_no])
                ->update(['code' => $code,'updated_at' => now(),]);
        }

    }

    public function verification($user){
        User::where(['country_id'=>$user->country_id,'phone_no'=>$user->phone_no])->first();
        $user->phone_verified_at=now();
        $user->save();
    }
    public function verificationEmail($user){
        User::where(['email'=>$user->email])->first();
        $user->email_verified_at=now();
        $user->save();
    }

    public function checkCode($model,$code,$user){
        $objectCode = $model->where(['code'=> $code,'country_id'=>$user->country_id,'phone_no'=>$user->phone_no])->first();
        // check if it does not expired: the time is one hour
        if(!$objectCode){
            return trans('messages.code is invalid, try again');
        }
        if ($objectCode->created_at > now()->addHour()) {
            $objectCode->delete();
            return trans('messages.code is expire');
        }

        return $user;
    }
}
