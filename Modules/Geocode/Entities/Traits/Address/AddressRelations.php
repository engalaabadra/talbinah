<?php
namespace Modules\Geocode\Entities\Traits\Address;
use Modules\Geocode\Entities\AddressType;

trait AddressRelations{
    
    public function addressType(){
        return $this->belongsTo(AddressType::class);
    }
    
}