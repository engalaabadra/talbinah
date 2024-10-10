<?php
namespace Modules\Reservation\Entities\Traits\Doctor;
use GeneralTrait;
trait ReasonReschedulingMethods{
    use GeneralTrait;

    //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where(['main_lang'=>$lang,'type'=>1])->paginate($request->total);
        else return $model->where('type',1)->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where(['main_lang'=>$lang,'type'=>1])->get();
        else return $model->where(['type'=>1])->get();
    }

}