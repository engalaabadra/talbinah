<?php
namespace Modules\Reservation\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\User\Resources\ReservationRepositoryInterface;
use Modules\Reservation\Entities\Traits\User\ReservationMethods;
use GeneralTrait;

class ReservationRepository extends EloquentRepository implements ReservationRepositoryInterface
{
    use GeneralTrait,ReservationMethods;
    public function all($request, $model){
        $status = status();
        $start = isStart();
        $end = isEnd();
        if($status  || $status=="0" || $start || $start =="0" || $end || $end =="0" ){
            if(page()) return $this->getPaginatesDataFilterMethod($request, $model);
            else return $this->getAllDataFilterMethod($model);
        }else{
            if(page()) return $this->getPaginatesDataMethod($request, $model);
            else return $this->getAllDataMethod($model);
        }
    }

    public function show($id,$model){
        $user = $this->showMethod($id,$model);
        return $user;
    }

    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    public function update($request,$model,$id){
        $user = $this->actionMethod($request,$model,$id);
        return $user;
    }

    public function cancel($request,$id,$model1,$model2){//model1:reservation , model2: wallet
        $user = $this->cancelMethod($request,$id,$model1,$model2);
        return $user;
    }
}
