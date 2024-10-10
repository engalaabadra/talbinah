<?php

namespace Modules\Specialty\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class SpecialtyResource extends JsonResource
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
            'name'      => $this->name,
            'description'      => $this->description,
            'image'      => $this->image,
            'is_report'      => $this->is_report,
            'active'      => $this->active,
            'original_active'      => $this->original_active,
                ];
    }
}
