<?php

namespace Modules\Reservation\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Services\User\ReservationService;
class ReservationServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReservationService
     */
    protected $reservationService;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ReservationServiceController constructor.
     *
     * @param ReservationService $reservations
     */
    public function __construct( Reservation $reservation,ReservationService $reservationService)
    {
        $this->reservation = $reservation;
        $this->reservationService = $reservationService;
    }

}
