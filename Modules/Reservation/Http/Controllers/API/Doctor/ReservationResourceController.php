<?php

namespace Modules\Reservation\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Repositories\Doctor\Resources\ReservationRepository;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Entities\Wallet;
use GeneralTrait;
use Modules\Reservation\Resources\Doctor\ReservationResource;
use Modules\Reservation\Http\Requests\Doctor\UpdateReservationRequest;
use Modules\Reservation\Http\Requests\Doctor\DeleteReservationRequest;

class ReservationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
     /**
     * @var Wallet
     */
    protected $wallet;
    
    /**
     * ReservationResourceController constructor.
     *
     * @param ReservationRepository $reservations
     */
    public function __construct( Reservation $reservation,Wallet $wallet,ReservationRepository $reservationRepo)
    {
        $this->reservation = $reservation;
        $this->wallet = $wallet;
        $this->reservationRepo = $reservationRepo;
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $reservations = $this->reservationRepo->all($request,$this->reservation);
        if($reservations==null) $reservations = [];
        if(page()) $data=getDataResponse(ReservationResource::collection($reservations));
        else $data=ReservationResource::collection($reservations);
        return successResponse(0,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation=$this->reservationRepo->show($id,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(0,new ReservationResource($reservation));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\UpdateReservationRequest  request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request,$id)
    {
        $reservation= $this->reservationRepo->update($request,$this->reservation,$id);
        if(is_numeric($reservation)) return  clientError(4);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(2,new ReservationResource($reservation));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteReservationRequest $request,$id)
    {
        $reservation= $this->reservationRepo->cancel($id,$this->reservation,$this->wallet);
        if(is_string($reservation)) return  clientError(0,$reservation);
        if(is_numeric($reservation)) return  clientError(4);
        return successResponse(2,new ReservationResource($reservation));  
    }

}
