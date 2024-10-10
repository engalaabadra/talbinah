<?php

namespace Modules\Appointment\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Appointment\Services\Doctor\AppointmentService;
class AppointmentServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var AppointmentService
     */
    protected $appointmentService;
        /**
     * @var Appointment
     */
    protected $appointment;
    
    /**
     * AppointmentServiceController constructor.
     *
     * @param AppointmentService $appointments
     */
    public function __construct( Appointment $appointment,AppointmentService $appointmentService)
    {
        $this->appointment = $appointment;
        $this->appointmentService = $appointmentService;
    }

}
