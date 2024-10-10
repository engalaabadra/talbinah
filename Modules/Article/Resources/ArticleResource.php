<?php

namespace Modules\Article\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\ArticleCategory\Resources\ArticleCategoryResource;

class ArticleResource extends JsonResource
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
            'article_category'=> ArticleCategoryResource::make($this->articleCategory),
            'keywords'      => $this->keywords->map(function($keyword){
                return $keyword->name;
             }),         
            'title'=> $this->title,
            'description'=> $this->description,
            'trending'=> $this->trending,
            'original_trending'=> $this->original_trending,
            'image'=> $this->image,
            'is_bookmark'=>isBookmark($this->id),//check if this doctor make a bookmark for this article
            'created_at'=> $this->created_at
            
        ];
    }
}
