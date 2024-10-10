<?php

namespace Modules\VisitChat\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Review\Traits\ReviewTraits;
use GeneralTrait;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Reservation\Resources\User\ReservationResource;
use Modules\Profile\Resources\UserResource;

class VisitChatResource extends JsonResource
{
    use GeneralTrait;
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
            'user'      => $this->user ? UserResource::make($this->user) :null,
            'doctor'=> $this->doctor? ProfileDoctorResource::make($this->doctor):null,            
            'reservation'=>ReservationResource::make($this->reservation),
            'visit_time_user'      => $this->visit_time_user,
            'visit_time_doctor'      => $this->visit_time_doctor,
            

        ];
    }
}
