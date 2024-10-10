<?php
namespace Modules\RequestWithdrawing\Repositories\Admin\Resources;

use Modules\RequestWithdrawing\Repositories\Admin\Resources\RequestWithdrawingRepositoryInterface;
use Modules\RequestWithdrawing\Entities\Traits\GeneralRequestWithdrawingTrait;

class RequestWithdrawingRepository implements RequestWithdrawingRepositoryInterface
{
    use GeneralRequestWithdrawingTrait;
    public function all($request, $model){
      return   $this->allReqsWithdrawingCompleted($model);
     }


    public function update($model){
        $requestWithdrawing = $this->change($model);
        return $requestWithdrawing;
    }
  }
  