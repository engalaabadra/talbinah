<?php
namespace Modules\Reservation\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\Doctor\Resources\ReservationRepositoryInterface;
use Modules\Reservation\Entities\Traits\Doctor\ReservationMethods;

class ReservationRepository extends EloquentRepository implements ReservationRepositoryInterface
{
    use ReservationMethods;
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
        $reservation = $this->showMethod($id,$model);
        return $reservation;
    }
    public function update($request,$model,$id){
        $reservation = $this->updateMethod($request,$model,$id);
        return $reservation;
    }
    public function cancel($id,$model1,$model2){//model1:reservation , model2: wallet
        $reservation = $this->cancelMethod($id,$model1,$model2);
        return $reservation;
    }
}

