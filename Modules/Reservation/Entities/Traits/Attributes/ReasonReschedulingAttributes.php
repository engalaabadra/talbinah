<?php
namespace Modules\Reservation\Entities\Traits\Attributes;

trait ReasonReschedulingAttributes{
  
        
    //Accessories
    public function getTypeeAttribute(){
        if(isset($this->attributes['type']))  return $this->attributes['type'];
    }
    public function getOriginalTypeeAttribute(){
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
