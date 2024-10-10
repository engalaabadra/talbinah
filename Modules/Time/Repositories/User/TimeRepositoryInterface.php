<?php
namespace Modules\Time\Repositories\User;

interface TimeRepositoryInterface
{
    public function getTimesDay($request,$model1,$model2,$model3,$model4,$dayId,$durationId,$doctorId);
}
