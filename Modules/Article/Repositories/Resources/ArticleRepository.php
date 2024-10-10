<?php
namespace Modules\Article\Repositories\Resources;

use Modules\Article\Repositories\Resources\ArticleRepositoryInterface;
use Modules\Article\Entities\Traits\ArticleMethods;
use App\Repositories\EloquentRepository;
class ArticleRepository extends EloquentRepository implements ArticleRepositoryInterface
{
    use ArticleMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
  
  

    public function search($model,$words,$col){
        $modelData = $this->searchMethod($model,$words,$col);
        return  $modelData;
    }
    
}
