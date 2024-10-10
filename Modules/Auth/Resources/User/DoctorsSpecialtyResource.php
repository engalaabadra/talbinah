<?php

namespace Modules\Auth\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class DoctorsSpecialtyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($this);
        return [
            'id'            => $this->id,
            'name'            => $this->name,
            'description'            => $this->description,
            'doctors'      => $this->doctors ? $this->doctors->map(function($doctor){
                                    return $doctor->full_name;
                                }) : null,
        ];
    }
}
