<?php
namespace Modules\Bookmark\Entities\Traits;
use Modules\Auth\Entities\User;
use Modules\Article\Entities\Article;

trait BookmarkRelations{
    
    public function article(){
        return $this->belongsTo(Article::class,'article_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
