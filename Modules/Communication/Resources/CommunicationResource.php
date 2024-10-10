<?php

namespace Modules\Communication\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class CommunicationResource extends JsonResource
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
            'main_lang'      => $this->main_lang,
            'translate_id'      => $this->translate_id,
            'name'      => $this->name,
            'description'      => $this->description,
            'image'      => $this->image,
            'price'      => $this->price,
            'active'         => $this->active,
            'original_active'         => $this->original_active,
            'created_at'         => $this->created_at,
        ];
    }
}
