<?php

namespace Modules\Appointment\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Appointment\Http\Requests\StoreAppointmentRequest;
use Modules\Appointment\Http\Requests\UpdateAppointmentRequest;
use Modules\Appointment\Http\Requests\DeleteAppointmentRequest;
use App\Repositories\EloquentRepository;
use Modules\Appointment\Repositories\Admin\Resources\AppointmentRepository;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Appointment\Resources\Admin\AppointmentResource;
 
class AppointmentResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepo;
        /**
     * @var Appointment
     */
    protected $appointment;

    /**
     * AppointmentsController constructor.
     *
     * @param AppointmentRepository $appointments
     */
    public function __construct(EloquentRepository $eloquentRepo, Appointment $appointment,AppointmentRepository $appointmentRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->appointment = $appointment;
        $this->appointmentRepo = $appointmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $appointments=$this->appointmentRepo->all($this->appointment,$lang);
        $data=AppointmentResource::collection($appointments);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $appointments=$this->appointmentRepo->getAllPaginates($this->appointment,$request,$lang);
        $data=getDataResponse(AppointmentResource::collection($appointments));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $appointments=$this->appointmentRepo->search($this->appointment,$words,$col);
        $data=getDataResponse(AppointmentResource::collection($appointments));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $appointments=$this->appointmentRepo->trash($this->appointment,$request);
        if(is_string($appointments)) return  clientError(4,$appointments);
        $data=getDataResponse(AppointmentResource::collection($appointments));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment=  $this->appointmentRepo->store($request,$this->appointment);
        if(is_string($appointment)) return  clientError(0,$appointment);
        return successResponse(1,new AppointmentResource($appointment));
    }
    public function storeTrans(StoreAppointmentRequest $request,$id,$lang)
    {
        $appointment=  $this->appointmentRepo->storeTrans($request,$this->appointment,$id,$lang);
        return successResponse(1,new AppointmentResource($appointment));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment=$this->appointmentRepo->show($id,$this->appointment);
        if(is_numeric($appointment)) return  clientError(4,$appointment);
        return successResponse(0,new AppointmentResource($appointment));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request,$id)
    {
        $appointment= $this->appointmentRepo->update($request,$this->appointment,$id);
        if(is_numeric($appointment)) return  clientError(4,$appointment);
        return successResponse(2,new AppointmentResource($appointment));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $appointment =  $this->appointmentRepo->restore($id,$this->appointment);
        if(is_string($appointment)) return  clientError(4,$appointment);
        return successResponse(5,new AppointmentResource($appointment));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $appointments =  $this->appointmentRepo->restoreAll($this->appointment);
        if(is_string($appointments)) return  clientError(4,$appointments);
        return customResponse(205,$appointments );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAppointmentRequest $request,$id)
    {
        $appointment= $this->appointmentRepo->destroy($id,$this->appointment);
        if(is_numeric($appointment)) return  clientError(4,$appointment);
        return successResponse(2,new AppointmentResource($appointment));
    }
    public function forceDelete(DeleteAppointmentRequest $request,$id)
    {
        //to make force destroy for a Appointment must be this Appointment  not found in Appointments table  , must be found in trash Categories
        $appointment=$this->appointmentRepo->forceDelete($id,$this->appointment);
        if(is_numeric($appointment)) return  clientError(4,$appointment);
        return successResponse(4,new AppointmentResource($appointment));
    }

}
