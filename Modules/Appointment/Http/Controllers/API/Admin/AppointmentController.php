<?php

namespace Modules\Appointment\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Appointment\Repositories\Admin\Additional\AppointmentRepository;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Appointment\Http\Controllers\API\Admin\AppointmentResourceController;
class AppointmentController extends AppointmentResourceController
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
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Appointment $appointment
     * @param AppointmentRepository $appointmentRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Appointment $appointment,AppointmentRepository $appointmentRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->appointment = $appointment;
        $this->appointmentRepo = $appointmentRepo;
    }

}
