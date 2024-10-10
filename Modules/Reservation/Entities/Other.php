<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\GeneralReservationTrait;
class Other extends Model
{
    use GeneralTrait,GeneralReservationTrait,SoftDeletes;
    protected $appends = ['original_type'];
    public $guarded = [];

}
