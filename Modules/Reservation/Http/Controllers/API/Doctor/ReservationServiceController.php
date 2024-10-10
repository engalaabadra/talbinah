<?php

namespace Modules\Reservation\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Services\Doctor\ReservationService;
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
