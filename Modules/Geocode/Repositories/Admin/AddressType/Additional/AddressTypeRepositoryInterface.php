<?php
namespace Modules\Geocode\Repositories\Admin\AddressType\Additional;

interface AddressTypeRepositoryInterface
{
    public function getAddressesType($model,$request,$countryId);
   
}
