<?php
namespace Modules\Payment\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Payment\Repositories\Admin\Resources\PaymentRepositoryInterface;
use Modules\Payment\Entities\Traits\GeneralPaymentTrait;
use GeneralTrait;

class PaymentRepository extends EloquentRepository implements PaymentRepositoryInterface
{
    use GeneralPaymentTrait,GeneralTrait;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    public function storeTrans($request,$model,$id){
        $payment = $this->actionMethod($request,$model,$id);
        return $payment;
    }

    public function update($request,$model,$id){
        $payment = $this->actionMethod($request,$model,$id);
        return $payment;
    }
}
