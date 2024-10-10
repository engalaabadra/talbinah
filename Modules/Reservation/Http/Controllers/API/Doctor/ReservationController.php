<?php

namespace Modules\Reservation\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Repositories\Doctor\Additional\ReservationRepository;
use Modules\Reservation\Repositories\Doctor\Resources\ReservationRepository as ReservationRepositoryResource;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Entities\Wallet;
use GeneralTrait;
use Modules\Reservation\Resources\Doctor\DoctorResource;
use Modules\Reservation\Resources\Doctor\ReservationResource;
use Modules\Reservation\Http\Requests\Doctor\AddNotesRequest;
use Modules\Reservation\Http\Requests\Doctor\GetReportReservationsRequest;
use Modules\Reservation\Resources\Doctor\ReservationNotesResource;
use Modules\Reservation\Resources\Doctor\CheckReservationResource;


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
     * @var Wallet
     */
    protected $wallet;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ReservationController constructor.
     *
     * @param ReservationRepository $reservations
     */
    public function __construct( Reservation $reservation,Wallet $wallet ,ReservationRepository $reservationRepo,ReservationRepositoryResource $reservationRepoResource)
    {
        $this->reservation = $reservation;
        $this->wallet = $wallet;
        $this->reservationRepo = $reservationRepo;
        $this->reservationRepoResource = $reservationRepoResource;
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getReservationsUser($userId , Request $request){
        $reservations = $this->reservationRepo->allReservationsUser($userId , $request,$this->reservation);
        if(is_numeric($reservations)) return  clientError(4);
        if(is_string($reservations)) return  clientError(0,$reservations);
        if(page()) $data=getDataResponse(ReservationResource::collection($reservations));
        else $data=ReservationResource::collection($reservations);
        return successResponse(0,$data);
    }
     /**
     * store the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\UpdateReservationRequest  request
     * @return \Illuminate\Http\Response
     */
    public function addNotes(Request $request,$id)
    {

        $reservation= $this->reservationRepo->addNotes($request,$this->reservation,$id);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(1,$reservation);
    }

    /**
     * update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\UpdateReservationRequest  request
     * @return \Illuminate\Http\Response
     */
    public function updateNotes(Request $request,$id)
    {
        $reservation= $this->reservationRepo->updateNotes($request,$this->reservation,$id);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(1,$reservation);
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
    public function switchVisit($reservationId)
    {
        $reservation=$this->reservationRepo->switchVisit($reservationId,$this->reservation,$this->wallet);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(0,new ReservationResource($reservation));
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
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(0,new CheckReservationResource($reservation));
    }
    
    public function getReportYearReservations(Request $request){
        $reportYearReservations=$this->reservationRepo->getReportYearReservations($request,$this->reservation);
        if(is_numeric($reportYearReservations)) return  clientError(4);
        if(is_string($reportYearReservations)) return  clientError(0,$reportYearReservations);
        return successResponse(0,$reportYearReservations);
    }

}

