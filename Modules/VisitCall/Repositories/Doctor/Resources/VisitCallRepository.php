<?php
namespace Modules\VisitCall\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\VisitCall\Repositories\Doctor\Resources\VisitCallRepositoryInterface;
use Modules\VisitCall\Entities\Traits\Doctor\VisitCallMethods;
use GeneralTrait;

class VisitCallRepository extends EloquentRepository implements VisitCallRepositoryInterface
{
    use GeneralTrait,VisitCallMethods;

    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    public function store($request,$model){
        $user = $this->actionMethodDoctor($request,$model);
        return $user;
    }

}
