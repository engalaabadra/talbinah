<?php

namespace Modules\Review\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Profile\Resources\UserResource;
use Modules\Reservation\Resources\User\ReservationResource;

class ReviewResource extends JsonResource
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
            'rating'      => $this->rating,
            'description'      => $this->description,
            'user'=> UserResource::make($this->user),
            'doctor'=> ProfileDoctorResource::make($this->doctor),
            'reservation'      => ReservationResource::make($this->reservation),

            
        ];
    }
}
