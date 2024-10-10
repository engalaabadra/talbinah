<?php
namespace Modules\Geocode\Repositories\Admin\State\Additional;

interface StateRepositoryInterface
{
    public function getAreasState($model,$request,$stateId);
   
}
