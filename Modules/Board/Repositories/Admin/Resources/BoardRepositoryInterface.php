<?php
namespace Modules\Board\Repositories\Admin\Resources;

interface BoardRepositoryInterface
{
   public function store($request,$model);
   public function update($request,$id,$model);

}
