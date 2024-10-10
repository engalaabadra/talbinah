<?php
namespace Modules\Appointment\Repositories\User;

use Modules\Appointment\Repositories\User\AppointmentRepositoryInterface;
use Modules\Appointment\Entities\Traits\User\AppointmentMethods;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    use AppointmentMethods;

}
