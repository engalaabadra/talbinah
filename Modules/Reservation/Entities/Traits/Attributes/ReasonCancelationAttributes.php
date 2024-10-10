<?php
namespace Modules\Reservation\Entities\Traits\Attributes;

trait ReasonCancelationAttributes{
  
        
    //Accessories
    public function getTypAttribute(){
        if(isset($this->attributes['type']))  return $this->attributes['type'];
    }
    public function getOriginalTypAttribute(){
        if(isset($this->attributes['type'])) {
            $value=$this->attributes['type'];
            if($value==0){
                return trans('attributes.User');
            }elseif ($value==1) {
                return trans('attributes.Doctor');
            }
        }
    }
 }
