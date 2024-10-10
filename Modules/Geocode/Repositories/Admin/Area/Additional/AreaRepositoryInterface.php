<?php
namespace Modules\Geocode\Repositories\Admin\Area\Additional;

interface AreaRepositoryInterface
{
    public function getAddressesTypesArea($model,$request,$areaId);
   
}
