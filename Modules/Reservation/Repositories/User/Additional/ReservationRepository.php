<?php
namespace Modules\Reservation\Repositories\User\Additional;

use Modules\Reservation\Repositories\User\Additional\ReservationRepositoryInterface;
use Modules\Reservation\Entities\Traits\User\ReservationMethods;

class ReservationRepository implements ReservationRepositoryInterface
{
    use ReservationMethods;

    public function checkVisit($reservationId,$model){
        return $this->checkVisitMethod($reservationId,$model);
    }
    public function checkReservation($reservationId,$model){
        return $this->checkReservationMethod($reservationId,$model);
    }

 

   
}
