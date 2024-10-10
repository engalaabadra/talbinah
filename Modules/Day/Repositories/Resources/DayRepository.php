<?php
namespace Modules\Day\Repositories\Resources;

use Modules\Day\Entities\Day;
use Modules\Day\Repositories\Resources\DayRepositoryInterface;
use GeneralTrait;
use  Modules\Day\Entities\Traits\User\DayMethods;
use App\Repositories\EloquentRepository;
class DayRepository extends  EloquentRepository implements DayRepositoryInterface
{
    use GeneralTrait,DayMethods;
  
}