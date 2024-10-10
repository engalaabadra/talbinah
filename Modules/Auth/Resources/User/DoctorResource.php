<?php

namespace Modules\Auth\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class DoctorResource extends JsonResource
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
            'id'            => $this->id,
            // 'specialty'      => $this->specialty?$this->specialty->name:null,
            'full_name'      => $this->full_name,
            'nick_name'      => $this->nick_name,
            'gender'      => intval($this->gender),
            'birth_date'      => $this->birth_date,
            'phone_no'      => $this->phone_no,
            'email'      => $this->email,
            'country'      => $this->country ? $this->country->name : null,
            'city'      => $this->city ? $this->city->name : null,
            

            

        ];
    }
}
