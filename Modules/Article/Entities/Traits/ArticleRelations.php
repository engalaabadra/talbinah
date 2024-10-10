<?php
namespace Modules\Article\Entities\Traits;
use App\Models\Image;
use Modules\ArticleCategory\Entities\ArticleCategory;
use Modules\Keyword\Entities\Keyword;
trait ArticleRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function articleCategory(){
        return $this->belongsTo(ArticleCategory::class);
    }
   
    public function keywords(){
        return $this->belongsToMany(Keyword::class,'keywords_articles','article_id','keyword_id');
    }
}
