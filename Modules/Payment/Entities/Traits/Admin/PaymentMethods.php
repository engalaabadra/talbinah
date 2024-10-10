<?php
namespace Modules\Payment\Entities\Traits\Admin;
use GeneralTrait;

trait PaymentMethods{
 //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
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
    //
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $payment=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $payment=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $payment=$this->find($model,$id,'id');
                if(is_numeric($payment)){
                    return $payment;
                }
                $payment->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$payment,$model,'payments-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $payment=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$payment,$model,'payments-images');
            }  
            //activity($model,'Store');

        }     
        return $payment;
    }
}