<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Address extends Model 
{

    use SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

      //relations
      public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
    public function addressType(){
        return $this->belongsTo(AddressType::class);
    }
    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    } 
}
