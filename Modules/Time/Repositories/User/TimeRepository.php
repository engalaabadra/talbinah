<?php
namespace Modules\Time\Repositories\User;

use Modules\Time\Repositories\User\TimeRepositoryInterface;
use Modules\Time\Traits\TimeTrait;
use GeneralTrait;

class TimeRepository implements TimeRepositoryInterface
{
    use GeneralTrait,TimeTrait;
    public function getTimesDay($request,$model1,$model2,$model3,$model4,$dayId,$durationId,$doctorId){//model1:time,model2:day,model3:duration,model4:user
        return $this->getTimesDayMethod($request,$model1,$model2,$model3,$model4,$dayId,$durationId,$doctorId);
    }
}