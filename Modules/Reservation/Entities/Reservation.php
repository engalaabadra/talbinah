<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\GeneralReservationTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use GeneralTrait,GeneralReservationTrait;

    protected $appends = ['original_active','original_status','original_gender'];
    public $guarded = [];



}
