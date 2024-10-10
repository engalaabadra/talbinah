<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\RegisterCodeNum;
use App\Services\MsegatSmsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ValidationNumberController extends Controller
{
    use GeneralTrait;

    public function validateNumber(Request $request)
    {
        if ($request->has('phone_no')) {
            $request->validate([
                'phone_no' => 'required|numeric|regex:/^\d+$/|digits_between:7,14|unique:users,phone_no',
                'country_id' => 'required|numeric|exists:countries,id'
            ]);
            $validateResponse = $this->validatePhoneNo($request->phone_no, $request->country_id);
            if ($validateResponse['message'] != null) {
                if (env('APP_ENV') == 'production') {
                    $data['code'] = strRandom();
                }else {
                    $data['code'] = '0000';
                }
                $data['validated'] = 'true';
                RegisterCodeNum::updateOrCreate(['phone_no' => $request->phone_no], [
                    'phone_number' => $request->phone_no,
                    'country_id' => $request->country_id,
                    'code' => $data['code'],
                ]);
                if (env('APP_ENV') == 'production') {
                    $response = app(MsegatSmsService::class)->sendVerifySms($validateResponse['validate_number'], $data['code']);
                    if ($response) {
                        return successResponse(0, $data, $validateResponse['message']);
                    }
                    return serverError(0);
                }else {
                    return successResponse(0, $data, $validateResponse['message']);
                }
            }
        } elseif ($request->has('email')) {

            $request->validate(['email' => 'email|unique:users,email']);
            $data = [
                'code' => "0000",  //TODO::strRandom()
                'validated' => 'true',
            ];
            RegisterCodeNum::updateOrCreate(['email' => $request->email], [
                'email' => $request->email,
                'code' => $data['code'],
            ]);
            return successResponse(0, $data, 'success');
        }
        return clientError(0, 'phone number not valid');

    }

    public function validateNumberLogin(Request $request)
    {
        if (!authUser()){
            return clientError(3,trans('messages.User does not have the necessary access rights'));
        }

        if ($request->has('phone_no')) {
            $request->validate([
                'phone_no' => [
                    'required',
                    'numeric',
                    'regex:/^\d+$/',
                    'digits_between:7,14',
                    Rule::unique('users', 'phone_no')->ignore(authUser()->phone_no, 'phone_no'),
                ],
                'country_id' => 'required|numeric|exists:countries,id'
            ]);
            $validateResponse = $this->validatePhoneNo($request->phone_no, $request->country_id);
            if ($validateResponse['message'] != null) {

                if (env('APP_ENV') == 'production') {
                    $data['code'] = strRandom();
                }else {
                    $data['code'] = '0000';
                }

                $data['validated'] = 'true';
                RegisterCodeNum::updateOrCreate(['phone_no' => $request->phone_no], [
                    'phone_number' => $request->phone_no,
                    'country_id' => $request->country_id,
                    'code' => $data['code'],
                ]);

                if (env('APP_ENV') == 'production') {

                    $response = app(MsegatSmsService::class)->sendVerifySms($validateResponse['validate_number'], $data['code']);
                    if ($response) {
                        return successResponse(0, $data, $validateResponse['message']);
                    }
                    return serverError(0);
                }else{
                    return successResponse(0, $data, $validateResponse['message']);
                }
            }
        } elseif ($request->has('email')) {

            $request->validate(['email' => 'email|unique:users,email']);
            $data = [
                'code' => "0000",  //TODO::strRandom()
                'validated' => 'true',
            ];
            RegisterCodeNum::updateOrCreate(['email' => $request->email], [
                'email' => $request->email,
                'code' => $data['code'],
            ]);
            return successResponse(0, $data,trans('messages.code_sent_success'));
        }
        return clientError(0, trans('messages.phone number not valid'));

    }

    public function checkVerifyNumber()
    {
        if (authUser()){
            if(authUser()->phone_verified_at === null){
                return clientError(0,trans('messages.you must verify your number'));
            }
            return auth()->guard('api')->user();
        }
        return clientError(3,trans('messages.User does not have the necessary access rights'));

    }
}
