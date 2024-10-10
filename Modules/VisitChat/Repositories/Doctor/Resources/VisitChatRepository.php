<?php
namespace Modules\VisitChat\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\VisitChat\Repositories\Doctor\Resources\VisitChatRepositoryInterface;
use Modules\VisitChat\Entities\Traits\Doctor\VisitChatMethods;
use GeneralTrait;

class VisitChatRepository extends EloquentRepository implements VisitChatRepositoryInterface
{
    use GeneralTrait,VisitChatMethods;

    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    public function store($request,$model){
        $user = $this->actionMethodDoctor($request,$model);
        return $user;
    }

}
