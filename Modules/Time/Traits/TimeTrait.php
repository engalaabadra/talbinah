<?php

namespace Modules\Time\Traits;


use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Traits\ReservationTrait;
use Carbon\Carbon;

trait TimeTrait
{
    use  ReservationTrait;

    public function getAvailableTimeSlots($start_time, $end_time, $durationInMinutes)
    {
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        $i = 1;
        $time = [];
        $init = $start;

        while ($i) {
            if ($start > $end) {
                $i = 0;
            } else {

                array_push($time, [
                    'start_time' => $start->format('H:i'),
                    'end_time' => $start->addMinutes($durationInMinutes)->format('H:i'),
                ]);
                if ($start > $end) {
                    unset($time[count($time) - 1]);
                    $i = 0;
                }
            }


        }
        return $time;


    }


    public function getTimesDayMethod($request, $model1, $model2, $model3, $model4, $dayId, $durationId, $doctorId = null)
    {//model1:appointment,model2:day,model3:duration,model4:user
        if(!$doctorId) $doctorId = authUser()->id;
        $doctor = $this->find($model4, $doctorId, 'id');
        $duration = $this->find($model3, $durationId, 'id');
        if (is_numeric($duration)) return 404;
        $day = $this->find($model2, $dayId, 'id');
        if (is_numeric($day)) return 404;
        //check if found reservation in same date in same day with same doctor (in same appointment), will seach in table reservation on same appointment in same date
        $appointmentsDoctor = $model1->where(['active' => '1', 'doctor_id' => $doctorId, 'day_id' => $dayId])->get();//start_time like : 8:00, end_time like:12:00 , day_id
        //make filtering for start_time , end_time according a duration
        //7:15 , 7:30 , 8:15 , 8:30
        //algo: search on ":" if after this ":" -> 00 will become 30 , if ->30 will become 00 and increase num. that before this ":" , and check if reach into 24:00 will become 00:00 not 24:00
        //1. list for all appointments from start_time into end_time
        if ($appointmentsDoctor) {
            foreach ($appointmentsDoctor as $appointmentDoctor) {//as -> 07:00 - 11:00 , 12:00 - 17:30 , 19:30 - 22:00 , 22:30 - 23:30
                $slots = [];
                $currentSlotStart = Carbon::createFromFormat('H:i:s', $appointmentDoctor->start_time);

                $reservations = Reservation::where('doctor_id', $doctorId)
                    ->where('date', $request['date'])
                    ->where('status', '!=', '-1')
                    ->orderBy('start_time')
                    ->get(['start_time', 'end_time']);

                $appointmentDoctorEndDate = Carbon::createFromFormat('H:i:s', $appointmentDoctor->end_time);
                while ($currentSlotStart < $appointmentDoctorEndDate) {

                    $currentSlotEnd = $currentSlotStart->copy()->addMinutes($duration->duration);
                    // Check for overlapping reservation
                    foreach ($reservations as $reservation) {
                        $reservationStart = Carbon::createFromFormat('H:i:s', $reservation->start_time);
                        $reservationEnd = Carbon::createFromFormat('H:i:s', $reservation->end_time);
                        if ($currentSlotStart < $reservationEnd && $currentSlotEnd > $reservationStart) {
                            $currentSlotStart = $reservationEnd->copy();
                            $currentSlotEnd = $currentSlotStart->copy()->addMinutes($duration->duration);
                        }
                    }

                    if ($currentSlotEnd <= $appointmentDoctorEndDate) {
                        array_push($slots, [
                            'start_time' => $currentSlotStart->format('H:i'),
                            'end_time' => $currentSlotEnd->format('H:i')
                        ]);
                    }

                    $currentSlotStart = $currentSlotEnd;
                }
                $appointmentDoctor->active = intval($appointmentDoctor->active);

                $appointmentDoctor->times = $slots;

            }
            return $appointmentsDoctor;

        }
    }
}
