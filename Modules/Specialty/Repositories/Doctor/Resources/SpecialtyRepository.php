<?php
namespace Modules\Specialty\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\Specialty\Repositories\Doctor\Resources\SpecialtyRepositoryInterface;
use Modules\Specialty\Entities\Traits\Doctor\SpecialtyMethods;
use GeneralTrait;

class SpecialtyRepository extends EloquentRepository implements SpecialtyRepositoryInterface
{
    use SpecialtyMethods,GeneralTrait;

    public function all($request, $model){
        if(page()) return $this->getPaginatesData($request, $model);
        else return $this->getAllData($model);
    }
    public function show($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)){
            return 404;
        }
        return $item->load(['doctors']);
    }

    
}
