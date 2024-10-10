<?php
namespace Modules\Communication\Repositories;

use Modules\Communication\Entities\Communication;
use Modules\Communication\Repositories\CommunicationRepositoryInterface;
use App\Repositories\EloquentRepository;
use GeneralTrait;
use Modules\Communication\Entities\Traits\CommunicationMethods;

class CommunicationRepository extends EloquentRepository implements CommunicationRepositoryInterface
{
    use GeneralTrait, CommunicationMethods;
     public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }


}