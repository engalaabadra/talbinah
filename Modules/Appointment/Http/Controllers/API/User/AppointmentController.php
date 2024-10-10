<?php

namespace Modules\Appointment\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Appointment\Repositories\User\AppointmentRepository;
use Modules\Appointment\Entities\Appointment;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Appointment\Resources\User\AppointmentResource;
class AppointmentController extends Controller
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
     * @var Appointment
     */
    protected $user;
    
    /**
     * AppointmentController constructor.
     *
     * @param AppointmentRepository $appointments
     */
    public function __construct( Appointment $appointment, User $user,AppointmentRepository $appointmentRepo)
    {
        $this->appointment = $appointment;
        $this->user = $user;
        $this->appointmentRepo = $appointmentRepo;
    }
    public function getAppointmentsNow(Request $request){
        $appointments = $this->appointmentRepo->appointmentsNow($request,$this->appointment);
        if(page()) $data=getDataResponse(appointmentResource::collection($appointments));
        else $data=AppointmentResource::collection($appointments);
        return successResponse(0,$data);
    }

}
