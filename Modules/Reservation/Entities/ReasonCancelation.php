<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\GeneralReservationTrait;

class ReasonCancelation extends Model
{
    use GeneralTrait,GeneralReservationTrait;

    protected $appends = ['original_type'];    
    public $table ='reasons_cancelation';
    public function reservations(){
        return $this->hasMany(Reservation::class,'reason_cancelation_id');
    }

}
