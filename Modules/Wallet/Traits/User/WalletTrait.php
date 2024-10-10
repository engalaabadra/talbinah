<?php
namespace Modules\Wallet\Traits\User;
use GeneralTrait;

trait WalletTrait{
    public function addIntoWallet($model,$price,$userId,$reservationId){
        //will add price into wallet user
        $priceShareTalbinah = calShareTalbinah($price);
        $wallet=$model->where(['user_id'=>$userId])->first();
        $priceShareUser=$price - $priceShareTalbinah;
        $wallet->balance = $wallet->balance + ($priceShareUser);
        $wallet->save();

        //add a movement
        $nameMovement = trans('messages.adding into wallet');
        $typeMovement = '1';//Deposition
        $role = 'user';
        $this->createMovement($model,$priceShareUser,$userId,$nameMovement,$typeMovement,$role,$reservationId);

        return $wallet;
    }
    public function addIntoWalletCallback($model,$price,$walletId){
        //will add price into wallet user
        $wallet=$model->where(['id'=>$walletId])->first();
        $wallet->balance = $wallet->balance + ($price);
        $wallet->save();
        
        return $wallet;
    }
}

