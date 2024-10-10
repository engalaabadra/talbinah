<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PasswordReset;
use Modules\Auth\Entities\User;
use App\Repositories\Auth\Recovery\Password\PasswordRepository;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\ResendCodeRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use GeneralTrait;
use ProccessSendingCodesService;
use SendingMessagesService;

class RecoveryPasswordController extends Controller
{
    use GeneralTrait;

    /**
     * @var PasswordRepository
     */
    protected $passwordRepo;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var PasswordReset
     */
    protected $passwordReset;
    public function __construct(User $user,PasswordReset $passwordReset,PasswordRepository $passwordRepo){
        $this->user = $user;
        $this->passwordRepo = $passwordRepo;
        $this->passwordReset = $passwordReset;

    }
    public function forgotPassword(ForgotPasswordRequest $request){
        $code = strRandom();  //TODO::strRandom()
        $result =  $request->processForgotPassword($request->validated(),$code,$this->passwordReset);
        if(is_string($result)) return  clientError(0,$result);
        return successResponse(0,message:  trans('messages.code_sent_success'));
    }

    public function checkCodeRecovery(CheckCodeRequest $request){
        $data=$request->validated();
        $user= $this->passwordRepo->checkCode($data,$this->passwordReset);
        if(is_string($user)) return  clientError(0,$user);
        $data=[
            'user'=>$user
        ];

        return successResponse(0,$data,trans('messages.Thanks,The code is valid'));
    }

    public function resendCodeRecovery(ResendCodeRequest $request){
        $code = strRandom();  //TODO::strRandom()
        $result= $this->passwordRepo->resendCode($request->validated(),$code,$this->passwordReset);
        if(is_string($result)) return  clientError(0,$result);


        return successResponse(0,(string)($result['code']),trans('messages.code_sent_success'));
    }

    public function resetPassword(ResetPasswordRequest $request){
        $passwordReset=$this->passwordRepo->resetPassword($request);
        if(is_string($passwordReset)) return  clientError(0,$passwordReset);

        $data = [
            'user'=>$passwordReset
        ];
        return customResponse(200,$data,trans('messages.Congrats...The password has been successfully recovered'));
    }

}
