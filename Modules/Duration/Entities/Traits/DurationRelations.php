<?php
namespace Modules\Duration\Entities\Traits;
use Modules\Appointment\Entities\Appointment;

trait DurationRelations{
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
