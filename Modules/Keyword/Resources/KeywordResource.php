<?php

namespace Modules\Keyword\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\KeywordCategory\Resources\User\KeywordCategoryResource;

class KeywordResource extends JsonResource
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
            'keyword_category'=> KeywordCategoryResource::make($this->keywordCategory),            
            'title'=> $this->title,
            'description'=> $this->description,
            'trending'=> $this->trending,
            'original_trending'=> $this->original_trending,
            'image'=> $this->image,
            'is_bookmark'=>isBookmark($this->id),//check if this doctor make a bookmark for this keyword
            'created_at'=> $this->created_at
            
        ];
    }
}
