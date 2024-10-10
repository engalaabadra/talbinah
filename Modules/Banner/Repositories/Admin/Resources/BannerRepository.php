<?php
namespace Modules\Banner\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\Admin\Resources\BannerRepositoryInterface;
use Modules\Banner\Entities\Traits\GeneralBannerTrait;
use GeneralTrait;

class BannerRepository extends EloquentRepository implements BannerRepositoryInterface
{
    use GeneralBannerTrait,GeneralTrait;
    
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
