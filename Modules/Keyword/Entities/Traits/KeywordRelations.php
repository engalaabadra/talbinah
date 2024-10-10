<?php
namespace Modules\Keyword\Entities\Traits;
use App\Models\Image;
use Modules\Article\Entities\Article;

trait KeywordRelations{
    public function articles(){
        return $this->belongsToMany(Article::class,'keywords_articles','keyword_id','article_id');
    }
}
