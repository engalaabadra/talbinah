<?php
namespace Modules\Payment\Repositories\Admin\Resources;

interface PaymentRepositoryInterface
{
   public function store($request,$model);
   public function update($request,$id,$model);

}
