<?php

namespace Modules\Appointment\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Appointment\Repositories\Doctor\Additional\AppointmentRepository;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Appointment\Resources\Doctor\AppointmentResource;
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
     * AppointmentController constructor.
     *
     * @param AppointmentRepository $appointments
     */
    public function __construct( Appointment $appointment,AppointmentRepository $appointmentRepo)
    {
        $this->appointment = $appointment;
        $this->appointmentRepo = $appointmentRepo;
    }

}
