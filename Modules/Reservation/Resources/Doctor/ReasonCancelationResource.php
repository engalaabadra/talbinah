<?php

namespace Modules\Reservation\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;
class ReasonCancelationResource extends JsonResource
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
             'reason'=>$this->reason,
             'type'=>$this->type,
             'original_type'=>$this->original_typ,
             'active'=>$this->active,
             'original_active'=>$this->original_active,
        ];
    }
}
