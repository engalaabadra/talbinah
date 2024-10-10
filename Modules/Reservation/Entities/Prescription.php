<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
class Prescription extends Model
{
    use GeneralTrait;
    protected $appends = ['original_active'];
    public $guarded = [];
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
