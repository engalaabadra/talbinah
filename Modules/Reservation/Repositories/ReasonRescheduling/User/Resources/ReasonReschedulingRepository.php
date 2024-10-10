<?php
namespace Modules\Reservation\Repositories\ReasonRescheduling\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\ReasonRescheduling\User\Resources\ReservationRepositoryInterface;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\User\ReasonReschedulingMethods;
class ReasonReschedulingRepository extends EloquentRepository implements ReasonReschedulingRepositoryInterface
{
    use GeneralTrait,ReasonReschedulingMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

}
