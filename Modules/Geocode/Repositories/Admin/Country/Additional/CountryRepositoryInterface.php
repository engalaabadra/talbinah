<?php
namespace Modules\Geocode\Repositories\Admin\Country\Additional;

interface CountryRepositoryInterface
{
    public function getCitiesCountry($model,$request,$countryId);
   
}
