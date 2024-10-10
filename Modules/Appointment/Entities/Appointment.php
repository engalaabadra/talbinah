<?php

namespace Modules\Appointment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use GeneralTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Appointment\Entities\Traits\GeneralAppointmentTrait;

class Appointment extends  Model
{
    use GeneralTrait,GeneralAppointmentTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];
   

}
