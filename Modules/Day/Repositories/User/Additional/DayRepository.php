<?php
namespace Modules\Day\Repositories\User\Additional;

use Modules\Day\Entities\Day;
use Modules\Day\Repositories\User\Additional\DayRepositoryInterface;
use GeneralTrait;
use  Modules\Day\Entities\Traits\User\DayMethods;
class DayRepository implements DayRepositoryInterface
{
    use GeneralTrait,DayMethods;
    public function getDaysDoctor($model1,$model2,$doctorId){//model:user
        return $this->getDaysDoctorMethod($model1,$model2,$doctorId);
    }

}