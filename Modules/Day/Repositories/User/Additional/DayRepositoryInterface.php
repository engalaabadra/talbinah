<?php
namespace Modules\Day\Repositories\User\Additional;

interface DayRepositoryInterface
{
    public function getDaysDoctor($model1,$model2,$doctorId);
}
