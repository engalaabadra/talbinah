<?php

namespace Modules\Appointment\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Appointment\Repositories\Doctor\Resources\AppointmentRepository;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Appointment\Resources\Doctor\AppointmentResource;
use Modules\Appointment\Http\Requests\Doctor\StoreAppointmentRequest;
use Modules\Appointment\Http\Requests\Doctor\UpdateAppointmentRequest;
use Modules\Appointment\Http\Requests\Doctor\DeleteAppointmentRequest;
class AppointmentResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepo;
        /**
     * @var Appointment
     */
    protected $appointment;
    
    /**
     * AppointmentResourceController constructor.
     *
     * @param AppointmentRepository $appointments
     */
    public function __construct( Appointment $appointment,AppointmentRepository $appointmentRepo)
    {
        $this->appointment = $appointment;
        $this->appointmentRepo = $appointmentRepo;
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $appointments = $this->appointmentRepo->all($request,$this->appointment);
        if(page()) $data=getDataResponse(appointmentResource::collection($appointments));
        else $data=AppointmentResource::collection($appointments);
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
        if(is_numeric($appointment)) return  clientError(4);
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
        if(is_numeric($appointment)) return  clientError(4);
        if(is_string($appointment)) return  clientError(0,$appointment);
        return successResponse(2,new AppointmentResource($appointment));
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
        if(is_numeric($appointment)) return  clientError(4);
        if(is_string($appointment)) return  clientError(0,$appointment);
        return successResponse(2);  
    }
     /**
     * change activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeActivate(Request $request,$id)
    {
        $appointment= $this->appointmentRepo->changeActivate($id,$this->appointment);
        if(is_numeric($appointment)) return  clientError(4);
        if(is_string($appointment)) return  clientError(0,$appointment);
        return successResponse(2,new AppointmentResource($appointment));
    }

}
