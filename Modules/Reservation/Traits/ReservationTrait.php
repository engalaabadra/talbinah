<?php

namespace Modules\Reservation\Traits;

use App\Traits\AuthTrait;
use Illuminate\Support\Facades\DB;
use Modules\Reservation\Entities\Reservation;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
use Carbon\Carbon;
use Modules\Wallet\Entities\Wallet;
use PHPUnit\Exception;

trait ReservationTrait
{
    use AuthTrait;

    public function querySearchReservation($query, $search)
    {
        if ($search) {
            if (is_numeric($search)) {
                $query->where('id', 'like', '%' . $search . '%');
            } else {
                $query->whereHas('doctor', function ($query) use ($search) {
                    $query->where('full_name', 'like', '%' . $search . '%');
                });
            }
        }
        return $query;//reservations
    }

    public function getReservationQuery($doctor, $date)
    {
        return Reservation::where(['doctor_id' => $doctor->id, 'date' => $date, 'status' => '1']);
    }

    public function getReservationQueryBetween($doctor, $date, $start_time, $end_time)
    {
        return Reservation::where('doctor_id', $doctor->id)
            ->where('date', $date)
            ->where('status', '1')
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($q) use ($start_time, $end_time) {
                    $q->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '>=', $start_time)
                            ->where('start_time', '<', $end_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('end_time', '>', $start_time)
                            ->where('end_time', '<=', $end_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '<', $start_time)
                            ->where('end_time', '>', $end_time);
                    });
            });
    }


    public function checkReservationsPatient($model, $data, $appointmentId, $doctor, $id = null)
    {
        $date = $data['date'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        if ($id) {
            $reservationBetweenTime = $this->getReservationQueryBetween($doctor, $date, $start_time, $end_time)->where('id', '!=', $id)->first();
        } else {
            $reservationBetweenTime = $this->getReservationQueryBetween($doctor, $date, $start_time, $end_time)->first();
        }
        if ($reservationBetweenTime) return trans('messages.You cannt add this reservation , because it is conflict with a another reservation and pay');

    }

    public function checkAppointmentsDoctor($doctorId, $reservationStartTime, $reservationEndTime, $dayId, $durationId)
    {
        $doctor = User::where('id', $doctorId)->first();

        if (!$doctor) return 404;

        $appointmentDoctor = $doctor->appointments()
            ->where(function ($query) use ($reservationStartTime, $reservationEndTime) {
                $query->whereBetween('start_time', [$reservationStartTime, $reservationEndTime])
                    ->orWhereBetween('end_time', [$reservationStartTime, $reservationEndTime])
                    ->orWhere(function ($query) use ($reservationStartTime, $reservationEndTime) {
                        $query->where('start_time', '<=', $reservationStartTime)
                            ->where('end_time', '>=', $reservationEndTime);
                    });
            })->where(['day_id' => $dayId])
            ->first();
        if (!$appointmentDoctor) return trans('messages.This time does not exist within the times of this day at this doctor');

        $start_time = strtotime($reservationStartTime);
        $end_time = strtotime($reservationEndTime);
        $duration = ($end_time - $start_time) / 60; // Duration in minutes
        $durationReq = Duration::where('id', $durationId)->first();
        if ($duration != $durationReq->duration) return trans('messages.start_time and end_time non-compatible with duration appointment this doctor');
        return $appointmentDoctor;
    }

    public function getReservationsSameTimeWithoutThisRes($reservationId, $appointmentId, $slot_start_time, $slot_end_time, $date)
    {
        return Reservation::where(['appointment_id' => $appointmentId, 'start_time' => $slot_start_time, 'end_time' => $slot_end_time, 'date' => $date, 'status' => '-1'])->where('id', '!=', $reservationId)->get();
    }

    public function getReservationsSameTimeStartWithoutThisRes($reservationId, $appointmentId, $slot_start_time, $date)
    {
        return Reservation::where(['appointment_id' => $appointmentId, 'start_time' => $slot_start_time, 'date' => $date, 'status' => '-1'])->where('id', '!=', $reservationId)->get();

    }

    public function getReservationsSameTimeEndWithoutThisRes($reservationId, $appointmentId, $slot_end_time, $date)
    {
        return Reservation::where(['appointment_id' => $appointmentId, 'end_time' => $slot_end_time, 'date' => $date, 'status' => '-1'])->where('id', '!=', $reservationId)->get();

    }

    public function getReservationsBetweenSlotsWithoutThisRes($reservationId, $appointmentId, $start_time, $end_time, $date)
    {
        return Reservation::where('id', '!=', $reservationId)
            ->where('date', $date)
            ->where('status', '!=', '0')
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($q) use ($start_time, $end_time) {
                    $q->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '>=', $start_time)
                            ->where('start_time', '<', $end_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('end_time', '>', $start_time)
                            ->where('end_time', '<=', $end_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '<', $start_time)
                            ->where('end_time', '>', $end_time);
                    });
            });
    }


    public function deleteAllReservationsNotPay($reservation, $appointment_id, $start_time, $end_time, $date)
    {
        $reservationsBetweenSlotsWithoutThisRes = $this->getReservationsBetweenSlotsWithoutThisRes($reservation->id, $appointment_id, $start_time, $end_time, $date);
        if ($reservationsBetweenSlotsWithoutThisRes) {
            foreach ($reservationsBetweenSlotsWithoutThisRes as $reservationSameTime) {
                if ($reservationSameTime->status == '1') {

                    $this->addIntoWalletCallback(new Wallet(), $reservation->price - precentageTalbinah($reservation->price), $reservation->user_id);
                    $reservation->delete();
                    return trans('messages.This reservation has been already paid');

                } else {
                    $reservationSameTime->delete();
                }

            }
        }
    }

    public function searchReservationsDoctorsAll($reservations, $search)
    {
        if (!$search) return $reservations;
        if (count($reservations) != 0) {
            if (is_numeric($search)) {
                $searchedReservations = collect($reservations)->filter(function ($reservation) use ($search) {
                    return strpos($reservation->id, $search) !== false;
                })->values()->all();
                return $searchedReservations;
            } else {
                $searchedReservations = collect($reservations)->filter(function ($reservation) use ($search) {
                    return strpos($reservation->doctor->full_name, $search) !== false;
                })->values()->all();
                return $searchedReservations;

            }
        }
    }


    public
    function paidReservation($doctor, $reservation)
    {
        //2. delete it , becuase all its not pay , and this reservation will become pay
        $this->deleteAllReservationsNotPay($reservation, $reservation->appointment_id, $reservation->start_time, $reservation->end_time, $reservation->date);
        //3. change status this reservation
        $reservation->update(['status' => '1']); //upcoming
    }

    public
    function changeTimeReservation($reservation)
    {
        $startTimeReservation = Carbon::parse(now());
        $durationInMinutes = $reservation->duration->duration;
        $endTimeReservation = $startTimeReservation->addMinutes($durationInMinutes)->format('H:i');
        $reservation->update(['start_time' => currentTime(), 'date' => currentDate(), 'end_time' => $endTimeReservation]);
    }

    public
    function remainingTimeReservation($doctorEntryTime,$duration)
    {
        return ($duration * 60 - ($this->diffDuration($doctorEntryTime)));
       
    }

}

