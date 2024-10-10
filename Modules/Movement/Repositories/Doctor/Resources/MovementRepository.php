<?php
namespace Modules\Movement\Repositories\Doctor\Resources;

use Modules\Movement\Repositories\Doctor\Resources\MovementRepositoryInterface;
use Modules\Movement\Entities\Traits\Doctor\MovementMethods;
use GeneralTrait;
use App\Repositories\EloquentRepository;


class MovementRepository extends EloquentRepository implements MovementRepositoryInterface
{
    use GeneralTrait,MovementMethods;
 
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
}
