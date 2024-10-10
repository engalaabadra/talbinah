<?php
namespace Modules\Wallet\Traits\Doctor;
use GeneralTrait;

trait WalletTrait{
    public function addIntoWallet($model,$price,$doctorId,$reservationId){
        //will add price into wallet doctor
        $wallet = $model->where('user_id',$doctorId)->first();
        $priceShareDoctor = calShareDoctor($price);
        $priceShareTalbinah = calShareTalbinah($price);
        $wallet->balance=$wallet->balance + $priceShareDoctor;
        $wallet->save();
        
        //add a movement
        $nameMovement = trans('messages.adding into wallet');
        $type = '1';//Deposition
        $role = 'doctor';
        $this->createMovement($model,$priceShareDoctor,$doctorId,$nameMovement,$type,$role,$reservationId);

        return $wallet;
    }
}

