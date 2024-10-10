<?php

namespace App\Http\Controllers\API\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\User\RegisterRequest;
use App\Models\RegisterCodeNum;
use App\Services\MsegatSmsService;
use App\Services\ProccessSendingCodesService;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Entities\User;
use App\Repositories\Auth\Register\User\RegisterRepository;
use GeneralTrait;

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

    public function __construct(RegisterRepository $regRepo, User $user, RegisterCodeNum $registerCodeNum)
    {
        $this->regRepo = $regRepo;
        $this->user = $user;
        $this->registerCodeNum = $registerCodeNum;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $regUser = $this->regRepo->register($request, $this->registerCodeNum);
        if (is_string($regUser)) return clientError(0, $regUser);
        $token = createToken($regUser);
        $data = [
            'token' => $token,
            'user' => $regUser,
        ];
        return successResponse(0, $data, trans('auth.Congrats...Registration completed successfully'));

    }


    public function checkCodeRegister(CheckCodeRequest $request)
    {
        $data = $request->validated();
        $objectCode = app(ProccessSendingCodesService::class)->checkCode($this->registerCodeNum, $data['code'], auth()->user());
        if (is_string($objectCode)) return clientError(0, $objectCode);
        app(ProccessSendingCodesService::class)->verification(auth()->user());
        $data = [
            'token' => getToken(),
            'user' => auth()->user(),
            'code' => (string)($data['code'])
        ];
        return successResponse(0, $data, trans('auth.Thanks,The code is valid'));
    }

    /**
     * @return JsonResponse
     */
    public function resendCodeRegister(): JsonResponse
    {
        if (env('APP_ENV') == 'production') {
            $code = getCode();
        }else {
            $code = '0000';
        }
        $user = authUser();
        if (!$user) return clientError(1);
        RegisterCodeNum::updateOrCreate(['phone_no' => $user->phone_no], [
            'phone_number' => $user->phone_no,
            'country_id' => $user->country_id,
            'code' => $code,
        ]);
        $number = fullNumber($user->phone_no,$user->country_id);
        if (env('APP_ENV') == 'production') {
            $response = app(MsegatSmsService::class)->sendVerifySms($number, $code);
            if ($response) {
                return successResponse(0, $user, trans('admin/dashboard.code_sent_success'));
            }
            return serverError(0);
        }else {
            return successResponse(0, $user, trans('admin/dashboard.code_sent_success'));
        }
    }
}

