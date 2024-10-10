<?php
namespace Modules\Reservation\Repositories\ReasonCancelation\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\ReasonCancelation\Doctor\Resources\ReservationRepositoryInterface;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\Doctor\ReasonCancelationMethods;
class ReasonCancelationRepository extends EloquentRepository implements ReasonCancelationRepositoryInterface
{
    use GeneralTrait,ReasonCancelationMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

}
