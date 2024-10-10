<?php
namespace Modules\Reservation\Entities\Traits;
use Modules\Reservation\Entities\Traits\ReservationScopes;
use Modules\Reservation\Entities\Traits\Relations\ReservationRelations;
use Modules\Reservation\Entities\Traits\Relations\OtherRelations;
use Modules\Reservation\Entities\Traits\Attributes\ReservationAttributes;
use Modules\Reservation\Entities\Traits\Attributes\ReasonReschedulingAttributes;
use Modules\Reservation\Entities\Traits\Attributes\ReasonCancelationAttributes;
use Modules\Reservation\Entities\Traits\Attributes\OtherAttributes;

trait GeneralReservationTrait{
   use ReservationScopes;
   use ReservationRelations;
   use OtherRelations;
   use ReservationAttributes;
   use ReasonReschedulingAttributes;
   use ReasonCancelationAttributes;
   use OtherAttributes;
}
