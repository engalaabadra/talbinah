<?php

namespace Modules\Reservation\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Http\Requests\StoreReservationRequest;
use Modules\Reservation\Http\Requests\UpdateReservationRequest;
use Modules\Reservation\Http\Requests\DeleteReservationRequest;
use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\Admin\Resources\ReservationRepository;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Resources\Admin\ReservationResource;

class ReservationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ReservationsController constructor.
     *
     * @param ReservationRepository $reservations
     */
    public function __construct(EloquentRepository $eloquentRepo, Reservation $reservation,ReservationRepository $reservationRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->reservation = $reservation;
        $this->reservationRepo = $reservationRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $reservations=$this->reservationRepo->all($this->reservation,$lang);
        $data=ReservationResource::collection($reservations);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $reservations=$this->reservationRepo->getAllPaginates($this->reservation,$request,$lang);
        $data=getDataResponse(ReservationResource::collection($reservations));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $reservations=$this->reservationRepo->search($this->reservation,$words,$col);
        $data=getDataResponse(ReservationResource::collection($reservations));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $reservations=$this->reservationRepo->trash($this->reservation,$request);
        if(is_string($reservations)) return  clientError(4,$reservations);
        $data=getDataResponse(ReservationResource::collection($reservations));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation=  $this->reservationRepo->store($request,$this->reservation);
        if(is_string($reservation)) return  clientError(0,$reservation);
        return successResponse(1,new ReservationResource($reservation));
    }
    public function storeTrans(StoreReservationRequest $request,$id,$lang)
    {
        $reservation=  $this->reservationRepo->storeTrans($request,$this->reservation,$id,$lang);
        return successResponse(1,new ReservationResource($reservation));
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
        if(is_numeric($reservation)) return  clientError(4,$reservation);
        return successResponse(0,new ReservationResource($reservation));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
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
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $reservation =  $this->reservationRepo->restore($id,$this->reservation);
        if(is_string($reservation)) return  clientError(4,$reservation);
        return successResponse(5,new ReservationResource($reservation));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $reservations =  $this->reservationRepo->restoreAll($this->reservation);
        if(is_string($reservation)) return  clientError(4,$reservation);
        return customResponse(205,$reservations );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteReservationRequest $request,$id)
    {
        $reservation= $this->reservationRepo->destroy($id,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4,$reservation);
        return successResponse(2,new ReservationResource($reservation));  
    }
    public function forceDelete(DeleteReservationRequest $request,$id)
    {
        //to make force destroy for a Reservation must be this Reservation  not found in Reservations table  , must be found in trash Categories
        $reservation=$this->reservationRepo->forceDelete($id,$this->reservation);
        if(is_numeric($reservation)) return  clientError(4,$reservation);
        return successResponse(4,new ReservationResource($reservation));
    }

}
