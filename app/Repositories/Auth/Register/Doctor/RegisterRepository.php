<?php
namespace App\Repositories\Auth\Register\Doctor;

use Illuminate\Support\Facades\Hash;
use GeneralTrait;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Illuminate\Support\Arr;

class RegisterRepository implements RegisterRepositoryInterface{
    use GeneralTrait,GeneralUserTrait;

    public function register($request,$model){//model2:registerCodeNum
        $resultReg = $request->has('email') || $request->has('phone_no') ? $request->actionRegister($request,$model,'doctor') : trans('messages.Pls, enter email or phone');
        session(['user' => $resultReg]);
        if (!is_string($resultReg)){
            $roles= $resultReg->roles->pluck('name')->toArray();
            if(!in_array('doctor',$roles)) return trans('messages.Invalid credentials');
        }
        return $resultReg;
    }
}
