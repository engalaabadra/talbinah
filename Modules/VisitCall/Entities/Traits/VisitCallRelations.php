<?php
namespace Modules\VisitCall\Entities\Traits;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
trait VisitCallRelations{
    
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
