<?php

namespace Modules\Appointment\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Reservation\Resources\Doctor\ReservationResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'start_time'=> $this->start_time,
            'end_time'=> $this->end_time,
            'day'=> $this->day ? $this->day->name:null,
            // 'active'=>!$this->deleted_at ? 1 : 0,
            'active'=>$this->active
        ];
    }
}
