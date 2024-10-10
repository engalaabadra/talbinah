<?php

namespace App\Console\Commands;

use App\Jobs\SendMsegatSmsJob;
use App\Services\SendingMessagesService;
use App\Services\SendingNotificationsService;
use Illuminate\Console\Command;
use Modules\Reservation\Entities\Reservation;

class ReminderSmsReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder-sms-reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $reservations = Reservation::where('date', now()->toDateString())
            ->where('start_time', '>=', now()->format('H:i:s'))
            ->where('start_time', '<=', now()->addMinutes(30)->format('H:i:s'))
            ->where('notified', false)
            ->with('doctor:id,phone_no,country_id,email', 'user')
            ->get();

        foreach ($reservations as $reservation) {
            $doctor = $reservation->doctor;
            $user = $reservation->user;
            if ($doctor->email) {
                //send to email doctor
                $data = [
                    'email' => $doctor->email,
                    'type' => 'reminder-reservation',
                    'user' => $reservation->user->full_name,
                    'user_birth_date' => $user->profile ? $user->profile->birth_date : null,
                    'doctor' => $doctor->full_name,
                    'reservation_date' => $reservation->date,
                    'reservation_start_time' => $reservation->start_time,
                    'reservation_end_time' => $reservation->end_time,
                    'reservation_problem' => $reservation->problem,
                    'to' => 'doctor'
                ];
                app(SendingMessagesService::class)->sendingMessage($data);
            }
            if ($user->email) {
                //send to email user
                $data = [
                    'email' => $user->email,
                    'type' => 'reminder-reservation',
                    'user' => $user->full_name,
                    'doctor' => $doctor->full_name,
                    'reservation_date' => $reservation->date,
                    'reservation_start_time' => $reservation->start_time,
                    'reservation_end_time' => $reservation->end_time,
                    'to' => 'user'
                ];
                app(SendingMessagesService::class)->sendingMessage($data);
            }

            $type = 'Reminder For Upcoming Reservation';
            $dataNotificationUser = $this->notificationData($reservation, $user, $doctor, 'user');
            $dataNotificationDoctor = $this->notificationData($reservation, $user, $doctor);
            app(SendingNotificationsService::class)->sendNotification($dataNotificationUser, $reservation->doctor_id, $type);
            app(SendingNotificationsService::class)->sendNotification($dataNotificationDoctor, $reservation->user_id, $type);
            $response = SendMsegatSmsJob::dispatch($doctor->phone_no, $doctor->country_id,$reservation);
            if ($response) $reservation->update(['notified' => true]);
        }


    }

    private function notificationData($data, $user, $doctor, $type = null)
    {
        if ($type == 'user') {
            return [
                'title' => trans('messages.reminder for upcoming reservation'),
                'body' => trans('messages.You have upcoming reservation with : ') . $user->full_name . trans('messages.reservation will start in 30 minutes'),
                'reservation' => $data,
                'doctor_name' => $doctor->full_name,
                'doctor_image' => $doctor->image,
            ];
        }
        return [
            'title' => trans('messages.reminder for upcoming reservation'),
            'body' => trans('messages.You have upcoming reservation with : ') . $doctor->full_name . trans('messages.reservation will start in 30 minutes'),
            'reservation' => $data,
            'doctor_name' => $doctor->full_name,
            'doctor_image' => $doctor->image,
        ];

    }
}


