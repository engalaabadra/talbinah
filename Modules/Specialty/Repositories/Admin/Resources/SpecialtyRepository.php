<?php
namespace Modules\Specialty\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Specialty\Repositories\Admin\Resources\SpecialtyRepositoryInterface;
use Modules\Specialty\Entities\Traits\GeneralSpecialtyTrait;
use GeneralTrait;

class SpecialtyRepository extends EloquentRepository implements SpecialtyRepositoryInterface
{
    use GeneralSpecialtyTrait,GeneralTrait;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }


    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    public function storeTrans($request,$model,$id){
        $board = $this->actionMethod($request,$model,$id);
        return $board;
    }

    public function update($request,$model,$id){
        $board = $this->actionMethod($request,$model,$id);
        return $board;
    }
    public  function trash($model,$request){
        if(is_string($this->findAllItemsOnlyTrashed($model))){
            return $this->findAllItemsOnlyTrashed($model);
        }
        $modelData = $this->findAllItemsOnlyTrashed($model)->with(['doctors'])->paginate($request->total);
        return $modelData;
    }
 
    public function show($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)){
            return 404;
        }
        return $item->load(['doctors']);
    }

    
}
