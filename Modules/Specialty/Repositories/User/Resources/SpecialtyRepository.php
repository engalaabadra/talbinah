<?php
namespace Modules\Specialty\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Specialty\Repositories\User\Resources\SpecialtyRepositoryInterface;
use Modules\Specialty\Entities\Traits\User\SpecialtyMethods;
use GeneralTrait;

class SpecialtyRepository extends EloquentRepository implements SpecialtyRepositoryInterface
{
    use SpecialtyMethods,GeneralTrait;

    public function all($request, $model){
        if(page()) return $this->getPaginatesData($request, $model);
        else return $this->getAllData($model);
    }
}
