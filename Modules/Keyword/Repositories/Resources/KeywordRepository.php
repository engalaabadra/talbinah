<?php
namespace Modules\Keyword\Repositories\Resources;

use Modules\Keyword\Repositories\Resources\KeywordRepositoryInterface;
use Modules\Keyword\Entities\Traits\KeywordMethods;
use App\Repositories\EloquentRepository;
class KeywordRepository extends EloquentRepository implements KeywordRepositoryInterface
{
    use KeywordMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
  
  

    public function search($model,$words,$col){
        $modelData = $this->searchMethod($model,$words,$col);
        return  $modelData;
    }
    
}
