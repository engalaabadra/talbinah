<?php
namespace Modules\Reservation\Repositories\Doctor\Additional;

use Modules\Reservation\Repositories\Doctor\Additional\ReservationRepositoryInterface;
use Modules\Reservation\Entities\Traits\Doctor\ReservationMethods;

class ReservationRepository implements ReservationRepositoryInterface
{
    use ReservationMethods;
    public function allReservationsUser($userId , $request, $model){
        if(page()) return $this->allReservationsUserPaginates($userId , $request, $model);
        else return $this->allReservationsUserData($userId , $request, $model);
    }
    
    public function addNotes($request,$model,$id){
        return $this->addNotesMethod($request,$model,$id);
    } 
    public function updateNotes($request,$model,$id){
        return $this->updateNotesMethod($request,$model,$id);
    } 
    public function notesPdfReservation($reservationId,$model){
        return $this->notesPdfReservationMethod($reservationId,$model);
    }
    public function switchVisit($reservationId,$model1,$model2){//model1:reservation , model2:wallet
        return $this->switchVisitMethod($reservationId,$model1,$model2);
    }
    public function checkVisit($reservationId,$model){
        return $this->checkVisitMethod($reservationId,$model);
    }
    public function checkReservation($reservationId,$model){
        return $this->checkReservationMethod($reservationId,$model);
    }

    public function getReportYearReservations($request,$model){
        return $this->reportYearReservationsMethod($request,$model);
    }
   
}
