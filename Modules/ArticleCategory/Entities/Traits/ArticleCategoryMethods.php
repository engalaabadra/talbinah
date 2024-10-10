<?php
namespace Modules\ArticleCategory\Entities\Traits;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
//use Modules\ArticleCategory\Traits\ArticleCategoryTrait;
use DateTime;
use DateInterval;

trait ArticleCategoryMethods{
    use GeneralTrait;
    
    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();   
        $doctor=authUser();
        $data['doctor_id'] =  $doctor->id;
        if($id){//update
                $item = $this->find($model,$id,'id');
                if(is_numeric($item)) return $item;//404(not found)
                // //check if this doctor have same time , day in another articleCategory 

                $anotherArticleCategoryDoctor = $model->where(['doctor_id'=>$doctor->id,'day_id'=>$data['day_id'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time']])->first();
                if($anotherArticleCategoryDoctor){
                    return trans('messages.You cannt update this articleCategory , because exist another articleCategory for you in same time and day');
                }
                $item->update($data);
                return $item;
        }else{
            //check if this doctor have same time , day in another articleCategory 
            $anotherArticleCategoryDoctor = $model->where(['doctor_id'=>$doctor->id,'day_id'=>$data['day_id'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time']])->first();
            if($anotherArticleCategoryDoctor){
                return trans('messages.You cannt add this articleCategory , because exist another articleCategory in same time and day');
            }
            $item = $model->create($data);
            return $item;
        }
    }

}
