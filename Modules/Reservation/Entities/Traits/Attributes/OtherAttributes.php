<?php
namespace Modules\Reservation\Entities\Traits\Attributes;

trait OtherAttributes{
    //Accessories
    public function getTypeAttribute(){//0: reason cancelation , 1:reason reschualing
        if(isset($this->attributes['type']))  return  intval($this->attributes['type']);
    }
    public function getOriginalTypeAttribute(){
        if(isset($this->attributes['type'])) {
            $value=$this->attributes['type'];
            if($value=='0'){
                return trans('attributes.Reason Cancelation');
            }elseif($value=='1'){
                return trans('attributes.Reason Reschualing');
            }
        }
    }

}
