<?php
namespace Modules\VisitCall\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\VisitCall\Repositories\User\Resources\VisitCallRepositoryInterface;
use Modules\VisitCall\Entities\Traits\User\VisitCallMethods;
use GeneralTrait;

class VisitCallRepository extends EloquentRepository implements VisitCallRepositoryInterface
{
    use GeneralTrait,VisitCallMethods;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }

}
