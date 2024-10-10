<?php
namespace Modules\Day\Entities\Traits;
use Modules\Duration\Entities\Duration;
use Modules\Appointment\Entities\Appointment;

trait DayRelations{
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }


}
