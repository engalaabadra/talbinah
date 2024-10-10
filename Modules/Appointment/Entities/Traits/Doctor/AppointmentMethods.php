<?php
namespace Modules\Appointment\Entities\Traits\Doctor;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
//use Modules\Appointment\Traits\AppointmentTrait;
use DateTime;
use DateInterval;

trait AppointmentMethods{
    use GeneralTrait;

    //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $this->queryGet($model,$lang)->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $this->queryGet($model,$lang)->get();
    }


    
    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();   
        $doctor=authUser();
        $data['doctor_id'] =  $doctor->id;
        $day_id=$data['day_id'];
        $start_time=$data['start_time'];
        $end_time=$data['end_time'];
        if($id){//update
                $item = $this->find($model,$id,'id');
                if(is_numeric($item)) return $item;//404(not found)
                //check if this doctor have this appointment to update on it
                if($doctor->id !== $item->doctor_id) return trans('messages.You cannt make this action , because this doctor havent this appointment');
                // //check if this doctor have same time , day in another appointment 
                $anotherAppointmentDoctor = $model->where('id', '!=', $item->id)
                                                ->where(['doctor_id'=>$doctor->id,'day_id'=>$day_id])
                                                ->where('active',1)
                                                ->where(function($query) use ($start_time, $end_time) {
                                                $query->whereBetween('start_time', [$start_time, $end_time])
                                                    ->orWhereBetween('end_time', [$start_time, $end_time])
                                                    ->orWhere(function($query) use ($start_time, $end_time) {
                                                        $query->where('start_time', '<', $start_time)
                                                                ->where('end_time', '>', $end_time);
                                                    });
                                                    })->first();
            if($anotherAppointmentDoctor){
                return  trans('messages.You cannot enter this appointment because it already conflicts with your previously entered appointments');
            }

                $item->update($data);
                return $item;
        }else{
            
            //check if this doctor have appointment  already conflicts with your previously entered appointments
            $anotherAppointmentDoctor = $model->where(['doctor_id'=>$doctor->id,'day_id'=>$day_id])
                                                ->where('active',1)
                                                ->where(function($query) use ($start_time, $end_time) {
                                                $query->whereBetween('start_time', [$start_time, $end_time])
                                                    ->orWhereBetween('end_time', [$start_time, $end_time])
                                                    ->orWhere(function($query) use ($start_time, $end_time) {
                                                        $query->where('start_time', '<', $start_time)
                                                                ->where('end_time', '>', $end_time);
                                                    });
                                                    })->first();
            if($anotherAppointmentDoctor){
                return  trans('messages.You cannot enter this appointment because it already conflicts with your previously entered appointments');
            }
            $item = $model->create($data);
            return $item;
        }
    }

    public function deleteMethod($id,$model,$forceDelete){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        
        if($item->deleted_at!==null){
            //this item already deleted permenetly , so now can make force delete for it
            if($forceDelete==0) return trans('messages.this item already deleted permenetly');

        }else{

            //check this appointment not contain on any reservations->will delete it finally
            if(count($item->reservations)==0) $item->delete();
            else $item->update(['active'=>0]);
            return $item;
        }
    }
    public function changeActivateMethod($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        $doctor=authUser();
        //check if this doctor have this appointment 
        if($doctor->id !== $item->doctor_id) return trans('messages.You cannt make this action , because this doctor havent this appointment');
        if($item->active == '1'){
            //check if not fount any reservrion in this appointment : will delete it
            if($item->reservations){
                $item->update(['active'=>'0']);
            }else{
              $item->delete();  
            }
        }elseif($item->active == '0') $item->update(['active'=>'1']);
        
        return $item;
        
    }
    

    
}
