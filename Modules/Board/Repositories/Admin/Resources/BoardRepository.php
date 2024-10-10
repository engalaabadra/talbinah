<?php
namespace Modules\Board\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Board\Repositories\Admin\Resources\BoardRepositoryInterface;
use Modules\Board\Entities\Traits\GeneralBoardTrait;
use GeneralTrait;

class BoardRepository extends EloquentRepository implements BoardRepositoryInterface
{
    use GeneralBoardTrait,GeneralTrait;
    
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
}
