<?php

namespace Modules\Reservation\Http\Controllers\WEB\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\Doctor\ReservationMethods;
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
    public function getReportReservations(Request $request,$doctorId)
    {
        $reservations=$this->reportReservationsMethod($request,$this->reservation,$doctorId);
        if(is_string($reservations)) return $reservations;
        return $reservations;
    }
    // public function getNotesReservationPdf($id)
    // {
    //     $reservation=$this->notesPdfReservationMethod($id,$this->reservation);
    //     return $reservation;
    // }
    
}

