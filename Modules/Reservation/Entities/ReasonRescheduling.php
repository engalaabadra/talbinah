<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Reservation\Entities\Reservation;
use App\Models\BaseModel;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\GeneralReservationTrait;

class ReasonRescheduling extends BaseModel
{
    use GeneralTrait,GeneralReservationTrait;

    protected $appends = ['original_type'];

    public $table ='reasons_rescheduling';

    public function reservations(){
        return $this->hasMany(Reservation::class,'reason_rescheduling_id');
    }
}
