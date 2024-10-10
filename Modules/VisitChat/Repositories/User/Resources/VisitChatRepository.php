<?php
namespace Modules\VisitChat\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\VisitChat\Repositories\User\Resources\VisitChatRepositoryInterface;
use Modules\VisitChat\Entities\Traits\User\VisitChatMethods;
use GeneralTrait;

class VisitChatRepository extends EloquentRepository implements VisitChatRepositoryInterface
{
    use GeneralTrait,VisitChatMethods;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }

}
