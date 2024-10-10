<?php
namespace Modules\Day\Repositories\Doctor\Additional;

use Modules\Day\Entities\Day;
use Modules\Day\Repositories\Doctor\Additional\DayRepositoryInterface;
use GeneralTrait;

class DayRepository implements DayRepositoryInterface
{
    use GeneralTrait;
   
    public function appointmentsDay($dayId,$model){//model : day
        $day= $model->where('id',$dayId)->first();
        if(!$day) return 404;
        return $day->appointments()->where('doctor_id',authUser()->id)->get();
    }
}