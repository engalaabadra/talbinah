<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\RegisterRequest;
use App\Services\VonageCheckValidateNumber;
use Modules\Auth\Entities\User;
use Modules\Geocode\Entities\Country;

class RegisterController extends Controller
{

    public function create(){

        $countries = Country::select('id','name')->orderBy('name','asc')->get();
        return view('pages.dynamic.register',[
            'countries' =>$countries
        ]);
    }
    public function store(RegisterRequest $request){
        $data = $request->except(['confirm_password','type','_token']);
        $number = fullNumber($request->phone_no,$request->country_id);
        $response = app(VonageCheckValidateNumber::class)->checkPhoneNumberValidity($number);
        if ($response['message'] != null){
            $user = User::create($data);
            if ($request->type == 0){
                $user->roles()->attach([3]);
            }else{
                $user->roles()->attach([4]);
            }
            return redirect()->to('success/'.$request->type);
        }
        return redirect()->back()->withErrors(['phone_no'=>'هذا الرقم غير صالح'])->withInput();

    }


}
