<?php
namespace Modules\RequestWithdrawing\Repositories\Doctor\Resources;

use Modules\RequestWithdrawing\Repositories\Doctor\Resources\RequestWithdrawingRepositoryInterface;
use Modules\RequestWithdrawing\Entities\Traits\Doctor\RequestWithdrawingMethods;

class RequestWithdrawingRepository implements RequestWithdrawingRepositoryInterface
{
    use RequestWithdrawingMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

  }
  