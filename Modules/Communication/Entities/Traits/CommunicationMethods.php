<?php
namespace Modules\Communication\Entities\Traits;
use GeneralTrait;
trait CommunicationMethods{
    use GeneralTrait;

     public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['image'])->where(['main_lang'=>$lang])->get();
    }
  //actions : store,update , store-trans
  public function actionMethod($request,$model,$id=null){
    $data=$request->validated();
    $enteredData=exceptData($data,['image']);
    
    $communication=null;
    if($id){ //update , storetrans
        if(isset(getallheaders()['lang'])){//storetrans
            $enteredData['translate_id']=$id;
            $enteredData['main_lang']=getallheaders()['lang'];
            $communication=$this->createUser($model,$enteredData);
          //  activity($model,'StoreTranslation');

        }else{//update
            $communication=$this->find($model,$id,'id');
            if(is_numeric($communication)){
                return $communication;
            }
            $communication->update($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$communication,$model,'communications-images',$id);
            }
            //activity($model,'Update');
        }
    }else{//store
        $communication=$model->create($enteredData);
        if(!empty($data['image'])){
            $this->uploadImage($request,$communication,$model,'communications-images');
        }  
        //activity($model,'Store');

    }     
    return $communication;
}  
}