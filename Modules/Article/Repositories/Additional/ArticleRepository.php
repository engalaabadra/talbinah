<?php
namespace Modules\Article\Repositories\Additional;

use Modules\Article\Repositories\Additional\ArticleRepositoryInterface;
use Modules\Article\Entities\Traits\ArticleMethods;
use App\Repositories\EloquentRepository;
class ArticleRepository extends EloquentRepository implements ArticleRepositoryInterface
{
    use ArticleMethods;
    public function getArticlesCategory($categoryId, $model){
        $articleCategory = $model->where('id',$categoryId)->first();
        if(!$articleCategory) return 404;
        return $articleCategory->articles;
    }
    public function getNewestArticles($request, $model){
        if(page()) return $this->getNewestArticlesPaginates($request, $model);
        else return $this->getNewestArticlesAll($model);
    }
    public function getTrendingArticles($request, $model){
        if(page()) return $this->getTrendingArticlesPaginates($request, $model);
        else return $this->getTrendingArticlesAll($model);
    }
 
    
}
