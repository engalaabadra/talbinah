<?php
namespace Modules\Reservation\Entities\Traits\Relations;
use Modules\Auth\Entities\User;
use Modules\Time\Entities\Time;
use Modules\Duration\Entities\Duration;
use Modules\Payment\Entities\Payment;
use Modules\Communication\Entities\Communication;
use Modules\Appointment\Entities\Appointment;
use Modules\Reservation\Entities\ReasonCancelation;
use Modules\Reservation\Entities\ReasonRescheduling;
use Modules\Review\Entities\Review;
use Modules\VisitChat\Entities\VisitChat;
use Modules\VisitCall\Entities\VisitCall;
use Modules\Reservation\Entities\Other;
use Modules\Reservation\Entities\ReservationFile;
use Modules\Reservation\Entities\Prescription;

trait ReservationRelations{
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function review(){
        return $this->hasOne(Review::class);
    }
    public function duration(){
        return $this->belongsTo(Duration::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function communication(){
        return $this->belongsTo(Communication::class);
    }
    public function reasonCancelation(){
        return $this->belongsTo(ReasonCancelation::class,'reason_cancelation_id');
    }
    public function reasonRescheduling(){
        return $this->belongsTo(ReasonRescheduling::class,'reason_rescheduling_id');
    }
    public function other(){
        return $this->hasOne(Other::class);
    }

    public function files(){
        return $this->hasMany(ReservationFile::class);
    }
    public function visitChat(){
        return $this->hasOne(VisitChat::class);
    }
    public function visitCall(){
        return $this->hasOne(VisitCall::class);
    }
    public function prescriptions(){
        return $this->hasMany(Prescription::class);
    }
}
