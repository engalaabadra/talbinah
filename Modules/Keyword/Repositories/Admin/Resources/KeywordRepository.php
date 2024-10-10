<?php
namespace Modules\Keyword\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Keyword\Repositories\Admin\Resources\KeywordRepositoryInterface;
use Modules\Keyword\Entities\Traits\GeneralKeywordTrait;

class KeywordRepository extends EloquentRepository implements KeywordRepositoryInterface
{
    use GeneralKeywordTrait;
    public function all($request, $model){
      if(page()) return $this->getPaginatesDataMethod($request, $model);
      else return $this->getAllDataMethod($model);
  }


  public function store($request,$model){
      $user = $this->actionMethod($request,$model);
      return $user;
  }
  }
  