<?php
namespace Modules\Geocode\Repositories\Admin\City\Additional;

interface CityRepositoryInterface
{
    public function getStatesCity($model,$request,$cityId);
   
}
