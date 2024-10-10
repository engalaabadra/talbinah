<?php
namespace Modules\Wallet\Entities\Traits\Doctor;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
use  Modules\Movement\Traits\MovementTrait;

trait WalletMethods{
    use MovementTrait;

    public function balance($model){
        $doctor=authUser();
        $wallet=$model->where('user_id',$doctor->id)->first();

       return  $wallet;
    }


    public function withdrawMethod($model1,$model2,$request){
        $data=$request->validated();
        $doctor=authUser();//doctor
        //check balance wallet
        $wallet=$model1->where(['user_id'=>$doctor->id])->first();
        if($wallet->balance==0) return trans('messages.You cannt withdraw from your wallet , because your balance equal 0');
        if($wallet->balance < config('vars.limit_withdraw')) return trans('messages.You cannt withdraw from your wallet , because your balance less than  limit withdraw').' = '.config('vars.limit_withdraw');
        if($wallet->balance < $data['amount']) return trans('messages.You cannt withdraw from your wallet , because your balance less than  your amount');

        //insert this req into requsts_withdrawing
        $data['status'] = '0';
        $data['wallet_id']= $doctor->wallet->id;
        $model2->insert($data);
        //decrease from wallet
        $wallet->balance = $wallet->balance - $data['amount'];
        $wallet->save();

        //add a movement
        $nameMovement = trans('messages.withdrawing from wallet');
        $type = '-1';//Withdrawing
        $role = 'doctor';
        $this->createMovement($model1,$data['amount'],$doctor->id,$nameMovement,$type,$role);
        return $wallet;
    }

}
