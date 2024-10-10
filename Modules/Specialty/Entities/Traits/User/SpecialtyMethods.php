<?php
namespace Modules\Specialty\Entities\Traits\User;
use GeneralTrait;

trait SpecialtyMethods{
    //get data//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model,localLang());
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->with(['doctors','image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model,localLang());
    }
    public function allDataMethod($model,$lang=null){
        return $model->with(['doctors','image'])->where(['main_lang'=>$lang])->get();
    }

    //get top -pagination-//
    public function getPaginatesTopSpecialties($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesTopSpecialties($request, $model,$lang);
        else return $this->paginatesTopSpecialties($request, $model);
    }
    public function paginatesTopSpecialties($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->with(['doctors','image'])->take(6)->paginate($request->total);
    }
    //get top  -all- //
    public function getAllTopSpecialties($model){
        if(isset(getallheaders()['lang']))  return $this->allTopSpecialties($model,getallheaders()['lang']);
        else return $this->allTopSpecialties($model);
    }
    public function allTopSpecialties($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['doctors','image'])->where(['main_lang'=>$lang])->take(6)->get();
    }

}
