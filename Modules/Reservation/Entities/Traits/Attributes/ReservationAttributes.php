<?php
namespace Modules\Reservation\Entities\Traits\Attributes;

trait ReservationAttributes{
  
        
    //Accessories
    public function getStatusAttribute(){
        if(isset($this->attributes['status']))  return  intval($this->attributes['status']);
    }
    public function getOriginalStatusAttribute(){
        if(isset($this->attributes['status'])) {
            $value=$this->attributes['status'];
            if($value=='-1'){//add reservation but not pay
                return trans('attributes.Pending');
            }elseif($value=='0'){
                return trans('attributes.Canceled');
            }elseif ($value=='1') {
                return trans('attributes.Upcoming');
            }
        }
    }
    public function getGenderAttribute(){
        if(isset($this->attributes['gender']))  return  intval($this->attributes['gender']);
    }
    public function getOriginalGenderAttribute(){
        if(isset($this->attributes['gender'])) {
            $value=$this->attributes['gender'];
            if($value=='0'){
                return trans('attributes.Male');
            }elseif ($value=='1') {
                return trans('attributes.Female');
            }
        }
    }

    public function getIsStartAttribute(){
        if(isset($this->attributes['is_start']))  return  intval($this->attributes['is_start']);
    }
    public function getOriginalIsStartAttribute(){
        if(isset($this->attributes['is_start'])) {
            $value=$this->attributes['is_start'];
            if($value=='0'){
                return trans('attributes.Not Start');
            }elseif ($value=='1') {
                return trans('attributes.Started');
            }
        }
    }

    public function getIsEndAttribute(){
        if(isset($this->attributes['is_end']))  return  intval($this->attributes['is_end']);
    }
    public function getOriginalIsEndAttribute(){
        if(isset($this->attributes['is_end'])) {
            $value=$this->attributes['is_end'];
            if($value=='0'){
                return trans('attributes.Not End');
            }elseif ($value=='1') {
                return trans('attributes.Ended');
            }
        }
    }

}
