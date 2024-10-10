<?php
namespace Modules\Time\Repositories\Doctor;

use Modules\Time\Entities\Time;
use Modules\Time\Repositories\Doctor\TimeRepositoryInterface;
use GeneralTrait;
use Modules\Time\Traits\TimeTrait;


class TimeRepository implements TimeRepositoryInterface
{
    use GeneralTrait,TimeTrait;
    public function all($model){
        $modelData=$model->withoutGlobalScope(LanguageScope::class)->get();
        return  $modelData;
    }
    public function getTimesDay($request,$model1,$model2,$model3,$model4,$dayId,$durationId){//model1:time,model2:day,model3:duration,model4:user
        return $this->getTimesDayMethod($request,$model1,$model2,$model3,$model4,$dayId,$durationId);
    }
}