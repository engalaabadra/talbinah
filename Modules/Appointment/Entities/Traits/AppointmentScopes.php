<?php
namespace Modules\Appointment\Entities\Traits;

trait AppointmentScopes{

 public function scopeActive($query)
    {
        return $query->where('active', '1');
    }
}

