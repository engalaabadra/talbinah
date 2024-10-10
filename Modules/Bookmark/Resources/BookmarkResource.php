<?php

namespace Modules\Bookmark\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Article\Resources\User\ArticleResource;

class BookmarkResource extends JsonResource
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
            'user'      => $this->user ? $this->user->full_name :null,
            'article'=> ArticleResource::make($this->article),
        ];
    }
}
