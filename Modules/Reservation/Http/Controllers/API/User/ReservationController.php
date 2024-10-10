<?php

namespace Modules\Reservation\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Repositories\User\Additional\ReservationRepository;
use Modules\Reservation\Repositories\User\Resources\ReservationRepository as ReservationRepositoryResource;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Resources\User\DoctorResource;
use Modules\Reservation\Resources\User\ReservationNotesResource;
use Modules\Reservation\Resources\User\ReservationResource;
use Modules\Reservation\Resources\User\CheckReservationResource;
use Modules\Reservation\Requests\User\SwitchVisitRequest;
class ReservationController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
    /**
     * @var ReservationRepositoryResource
     */
    protected $reservationRepoResource;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ReservationController constructor.
     *
     * @param ReservationRepository $reservations
     */
    public function __construct( Reservation $reservation,ReservationRepository $reservationRepo,ReservationRepositoryResource $reservationRepoResource)
    {
        $this->reservation = $reservation;
        $this->reservationRepo = $reservationRepo;
        $this->reservationRepoResource = $reservationRepoResource;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getNotesReservation($id)
    {
        $reservation=$this->reservationRepoResource->show($id,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(0,new ReservationNotesResource($reservation));
    }



    public function checkVisit($reservationId)
    {
        $reservation=$this->reservationRepo->checkVisit($reservationId,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(0,$reservation);
    }
    public function checkReservation($reservationId)
    {
        $reservation=$this->reservationRepo->checkReservation($reservationId,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4);
        

        if(is_string($reservation))  return response()->json(['status'=>false,'message'=>$reservation,'data'=>[]],200);
        return successResponse(0,new CheckReservationResource($reservation));
    }

}
