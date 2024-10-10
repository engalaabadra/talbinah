<?php
namespace App\Repositories\Auth\Register\User;

use Illuminate\Support\Facades\Hash;
use GeneralTrait;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Illuminate\Support\Arr;

class RegisterRepository implements RegisterRepositoryInterface{
    use GeneralTrait,GeneralUserTrait;

    public function register($request,$model){//model2:registerCodeNum
        $resultReg = $request->has('email') || $request->has('phone_no') ? $request->actionRegister($request,$model,'user') : trans('messages.Pls, enter phone');
        session(['user' => $resultReg]);
        return $resultReg;
    }
}
