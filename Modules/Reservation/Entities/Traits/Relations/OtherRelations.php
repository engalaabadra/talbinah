<?php
namespace Modules\Reservation\Entities\Traits\Relations;
use Modules\Reservation\Entities\Reservation;
use Modules\ReasonCancelation\Entities\ReasonCancelation;

trait OtherRelations{
    
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

}
