<?php
namespace Modules\Specialty\Entities\Traits\Doctor;
use GeneralTrait;

trait SpecialtyMethods{
    //get data//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->with(['doctors','image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['doctors','image'])->where(['main_lang'=>$lang])->get();
    }

}
