<?php
namespace Modules\Article\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Article\Repositories\Admin\Resources\ArticleRepositoryInterface;
use Modules\Article\Entities\Traits\GeneralArticleTrait;

class ArticleRepository extends EloquentRepository implements ArticleRepositoryInterface
{
    use GeneralArticleTrait;
    public function all($request, $model){
      if(page()) return $this->getPaginatesDataMethod($request, $model);
      else return $this->getAllDataMethod($model);
  }


    public function store($request,$model){
        $article = $this->actionMethod($request,$model);
        return $article;
    }
    public function update($request,$model,$id){
        $article = $this->actionMethod($request,$model,$id);
        return $article;
    }
  }
  