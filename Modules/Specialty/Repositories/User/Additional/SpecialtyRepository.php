<?php
namespace Modules\Specialty\Repositories\User\Additional;

use Modules\Specialty\Repositories\User\Additional\SpecialtyRepositoryInterface;
use Modules\Specialty\Entities\Traits\User\SpecialtyMethods;
use GeneralTrait;
class SpecialtyRepository implements SpecialtyRepositoryInterface
{
    use SpecialtyMethods,GeneralTrait;

    public function getTopSpecialties($request, $model){
        if(page()) return $this->getPaginatesTopSpecialties($request, $model);
        else return $this->getAllTopSpecialties($model);
    }


}
