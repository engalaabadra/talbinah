<?php
namespace Modules\Reservation\Repositories\ReasonCancelation\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\ReasonCancelation\User\Resources\ReservationRepositoryInterface;
use GeneralTrait;

class ReasonCancelationRepository extends EloquentRepository implements ReasonCancelationRepositoryInterface
{
    use GeneralTrait;


}
