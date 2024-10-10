<?php
namespace Modules\RequestWithdrawing\Entities\Traits\Doctor;
use GeneralTrait;
use Modules\Wallet\Entities\Wallet;

trait RequestWithdrawingMethods{
    use GeneralTrait;
    //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        $doctor = authUser();
        $wallet=Wallet::where('user_id',$doctor->id)->first();
        return $model->where('wallet_id',$wallet->id)->paginate($request->total);
    }

    //get data -all- //
    public function getAllDataMethod($model){
        $doctor = authUser();
        $wallet=Wallet::where('user_id',$doctor->id)->first();
        return $model->where('wallet_id',$wallet->id)->get();
    }

}
