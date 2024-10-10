<?php

namespace Modules\Reservation\Http\Controllers\WEB\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\User\ReservationMethods;
class ReservationController extends Controller
{
    use GeneralTrait,ReservationMethods;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ReservationController constructor.
     *
     * @param ReservationRepository $reservations
     */
    public function __construct( Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
    public function getNotesReservationPdf($id)
    {
        $reservation=$this->notesPdfReservationMethod($id,$this->reservation);
        return $reservation;
    }
    public function randomLink()
    {
        $reservation=$this->randomLinkMethod($this->reservation);
        return $reservation;
    }
}

