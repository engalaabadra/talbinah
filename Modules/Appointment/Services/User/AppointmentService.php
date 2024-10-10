<?php
namespace Modules\Appointment\Services\User;

use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Services\User\UserServiceInterface;
use Modules\Appointment\Traits\GeneralAppointmentTrait;

class AppointmentService  implements AppointmentServiceInterface
{
    use GeneralAppointmentTrait;


}
