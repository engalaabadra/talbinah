<?php
use App\Models\PersonalAccessToken;
use Modules\Auth\Entities\User;
use Illuminate\Auth\Access\AuthorizationException;


function getToken(){
    $allHeaders=getallheaders();
    if(isset($allHeaders['Authorization'])){
        $tokenHeader=substr($allHeaders['Authorization'],7);
        return $tokenHeader;

    }else{
        return 401;
    }
}

function authUser(){
    return auth()->guard('api')->user();
}

function createToken($user){
    return $user->createToken('token')->accessToken;
}

/**
 * Handle a failed authorization attempt.
 *
 * @return void
 *
 * @throws \Illuminate\Auth\Access\AuthorizationException
 */
function failedAuthorization()
{
    throw new AuthorizationException(trans('You havent Authorization to make this action'));
}
function failedAction()
{
    throw new AuthorizationException(trans('You cannt make this action'));
}
