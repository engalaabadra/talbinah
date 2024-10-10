<?php
namespace Modules\VisitChat\Entities\Traits\User;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
use SendingNotificationsService;

trait VisitChatMethods{
    use GeneralTrait{
        GeneralTrait::getPaginatesData as getPaginatesDataMethod;
        GeneralTrait::paginatesData as paginatesDataMethod;
        GeneralTrait::action as actionMethod;
    }
      //get data//
      public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->where('user_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->paginate($request->total);
        else return $model->withoutGlobalScope(ActiveScope::class)->where('user_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where('user_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->where(['main_lang'=>$lang])->get();
        else return $model->where('user_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->get();
    }

    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();    
        $user=authUser();

        //check if this reservation for this user : prevent visti it for another user
        $reservation = Reservation::where(['id'=>$data['reservation_id']])->first();
        if($reservation->user_id !== $user->id) return trans('messages.you cannt enter into  this reservation , because you havent it');

        //check this reservation just status : paid to enter here
        if($reservation->status == '-1') return trans('messages.this reservation not paid until now , so you cannt enter into it');
        if($reservation->status == '0') return trans('messages.this reservation canceled , so you cannt enter into it');
        if($reservation->is_end == '1') return trans('messages.this reservation has been ended');


        //check if this reservation exist in table visits : get this col. to know if visited it from a user or a doctor
        $visitReservation = $model->where(['reservation_id'=>$data['reservation_id']])->first();

        //if  vistied it from a user will update on it to add this user in this col. and visit_time
        //if vistied it from a user : cannt add it again or update on it
        if($visitReservation){
            if($visitReservation->doctor_id!=null){
                if($visitReservation->user_id!==null){
                    return $visitReservation;
                }else{
                    $visitReservation->user_id=$user->id;
                    $visitReservation->visit_time_user=now();
                    $visitReservation->save();
                    // $dataNotification = [
                    //     'title'=> trans('messages.New Chat'),
                    //     'body'=> trans('messages.You have received a new chat from : ') . authUser()->full_name . trans('messages.,at:') . $visitReservation->visit_time_user,
                    //     'visit_id'=>$visitReservation->id,
                    //     'reservation'=>$reservation
    
                    // ];
                    // $type='New Visit Chat';
                    // app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->doctor_id,$type);
                    
                    return $visitReservation;
                }
            }else{
                return $visitReservation;
            }

        }else{
            //if no : add it
            $data['user_id']=authUser()->id;
            $data['doctor_id']=$reservation->doctor_id;
            $data['visit_time_user']=now();
            $visit = $model->create($data);
            $dataNotification = [
                'title'=> trans('messages.New Chat'),
                'body'=> trans('messages.You have received a new chat from : ') . authUser()->full_name . trans('messages.,at:') . $visit->visit_time_user,
                'visit_id'=>$visit->id,
                'reservation'=>$reservation

            ];
            $type='New Visit Chat';
            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->doctor_id,$type);
            return $visit;

        }
        

    }

}
