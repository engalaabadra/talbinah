<?php
namespace Modules\Specialty\Entities\Traits\Admin;
use GeneralTrait;

trait SpecialtyMethods{
   
   
    //actions : store, update
    
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $specialty=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $specialty=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $specialty=$this->find($model,$id,'id');
                if(is_numeric($specialty)){
                    return $specialty;
                }
                $specialty->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$specialty,$model,'specialties-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $specialty=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$specialty,$model,'specialties-images');
            }  
            //activity($model,'Store');

        }
        return $specialty;
    }
}
