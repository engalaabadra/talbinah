<?php
namespace Modules\Appointment\Http\Controllers\API\Admin;
use Modules\Appointment\Http\Controllers\API\Admin\AppointmentController;
use Modules\Appointment\Services\Admin\AppointmentService;
class AppointmentServiceController extends AppointmentController
{
    /**
     * @var AppointmentService
     */
    protected $appointmentService;
      
    
    /**
     * AppointmentServiceController constructor.
     *
     */
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    //to calling method service for Appointment : 1. using object from it 2. register in app service container and using it
    
 }