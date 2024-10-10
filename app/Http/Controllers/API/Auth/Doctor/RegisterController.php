<?php

namespace  App\Http\Controllers\API\Auth\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\Doctor\RegisterRequest;
use App\Models\RegisterCodeNum;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Entities\User;
use App\Repositories\Auth\Register\Doctor\RegisterRepository;
use GeneralTrait;
use Modules\Auth\Entities\User\GeneralUserTrait;
class RegisterController extends Controller
{
    use GeneralTrait;
    /**
     * @var RegisterRepository
     */
    protected $regRepo;
    /**
     * @var User
     */
    protected $user;
    /**
    * @var RegisterCodeNum
    */
   protected $registerCodeNum;

    public function __construct(RegisterRepository $regRepo,User $user,RegisterCodeNum $registerCodeNum){
        $this->regRepo = $regRepo;
        $this->user = $user;
        $this->registerCodeNum=$registerCodeNum;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request):JsonResponse
    {
//        $code=StrRandom();
        $regUser =  $this->regRepo->register($request,$this->registerCodeNum);
        if(is_string($regUser)) return  clientError(0,$regUser);
        $token=createToken($regUser);
        $data=[
            'token'=> $token ,
            'doctor'=> $regUser,
        ];
        return successResponse(0,$data,trans('auth.Congrats...Registration completed successfully'));

    }

}

