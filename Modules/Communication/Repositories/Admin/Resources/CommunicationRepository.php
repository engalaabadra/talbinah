<?php
namespace Modules\Communication\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Communication\Repositories\Admin\Resources\CommunicationRepositoryInterface;
use Modules\Communication\Entities\Traits\GeneralCommunicationTrait;
use GeneralTrait;

class CommunicationRepository extends EloquentRepository implements CommunicationRepositoryInterface
{
    use GeneralCommunicationTrait,GeneralTrait;
    
    
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
