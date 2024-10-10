<?php
namespace Modules\Appointment\Services\Doctor;

use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Services\Doctor\AppointmentServiceInterface;
use Modules\Appointment\Traits\GeneralAppointmentTrait;

class AppointmentService  implements AppointmentServiceInterface
{
    use GeneralAppointmentTrait;


}
