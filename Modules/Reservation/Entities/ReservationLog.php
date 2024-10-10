<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Appointment\Entities\Appointment;
use GeneralTrait;
use Modules\Reservation\Entities\Traits\GeneralReservationTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationLog extends Model
{
    use GeneralTrait,GeneralReservationTrait;
    protected $table = 'reservations_logs';
    protected $appends = ['original_active','original_status','original_gender'];
    public $guarded = [];

    public function createReservationLog($reservation){
        $reservation_log =  new $this();
        $reservation_log->reservation_id = $reservation->id;
        $reservation_log->doctor_id = $reservation->doctor_id;
        $reservation_log->user_id = $reservation->user_id;
        $reservation_log->appointment_id = $reservation->appointment_id;
        $reservation_log->duration_id = $reservation->duration_id;
        $reservation_log->price = $reservation->price;
        $reservation_log->start_time = $reservation->start_time;
        $reservation_log->end_time = $reservation->end_time;
        $reservation_log->communication_id = $reservation->communication_id;
        $reservation_log->reason_cancelation_id = $reservation->reason_cancelation_id;
        $reservation_log->reason_rescheduling_id = $reservation->reason_rescheduling_id;
        $reservation_log->payment_id = $reservation->payment_id;
        $reservation_log->full_name = $reservation->full_name;
        $reservation_log->age = $reservation->age;
        $reservation_log->gender = strval($reservation->gender);
        $reservation_log->problem = $reservation->problem;
        $reservation_log->date = $reservation->date;
        $reservation_log->notes = $reservation->notes;
        $reservation_log->message = $reservation->message;
        $reservation_log->report = $reservation->report;
        $reservation_log->link = $reservation->link;
        $reservation_log->filename = $reservation->filename;
        $reservation_log->is_start = strval($reservation->is_start);
        $reservation_log->is_end = strval($reservation->is_end);
        $reservation_log->status = strval($reservation->status);
        $reservation_log->active = strval($reservation->active);
        $reservation_log->reference_payment_id = $reservation->reference_payment_id;
        $reservation_log->save();
        return $reservation_log;
    }

}
