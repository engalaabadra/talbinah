<?php
namespace Modules\VisitChat\Entities\Traits\Doctor;
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
        return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model){
        return $model->withoutGlobalScope(ActiveScope::class)->where('doctor_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        return $this->allDataMethod($model);
    }
    public function allDataMethod($model){
        return $model->where('doctor_id',authUser()->id)->with(['doctor','user','reservation.communication.image'])->get();
    }

    public function actionMethodDoctor($request,$model,$id=null){
        $data = $request->validated();    
        $doctor=authUser();

        //check if this reservation for this doctor : prevent visti it for another doctor
        $reservation = Reservation::where(['id'=>$data['reservation_id']])->first();
        if($reservation->doctor_id !== $doctor->id) return trans('messages.you cannt enter into  this reservation , because you havent it');

        //check this reservation just status : paid to enter here
        if($reservation->status == '-1') return trans('messages.this reservation not paid until now , so you cannt enter into it');
        if($reservation->status == '0') return trans('messages.this reservation canceled , so you cannt enter into it');
        if($reservation->is_end == '1') return trans('messages.this reservation has been ended');


        //check if this reservation exist in table visits : get this col. to know if visited it from a user or a doctor
        $visitReservation = $model->where(['reservation_id'=>$data['reservation_id']])->first();

        //if  vistied it from a user will update on it to add this doctor in this col. and visit_time
        //if vistied it from a doctor : cannt add it again or update on it
        if($visitReservation){
            if($visitReservation->user_id!=null){
                if($visitReservation->doctor_id!==null){
                    return $visitReservation;
                }else{
                    $visitReservation->doctor_id=$doctor->id;
                    $visitReservation->visit_time_doctor=now();
                    $visitReservation->save();
                    // $dataNotification = [
                    //     'title'=> trans('messages.New Chat'),
                    //     'body'=> trans('messages.You have received a new chat from : ') . authUser()->full_name . trans('messages.,at:') . $visitReservation->visit_time_doctor,
                    //     'visit_id'=>$visitReservation->id,
                    //     'reservation'=>$reservation
    
                    // ];
                    // $type='New Visit Chat';
                    // app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
                    return $visitReservation;
                }
            }else{
                return $visitReservation;
            }

        }else{
            //if no : add it
            $data['doctor_id']=authUser()->id;
            $data['user_id']=$reservation->user_id;
            $data['visit_time_doctor']=now();
            $visit = $model->create($data);
            $dataNotification = [
                'title'=> trans('messages.New Chat'),
                'body'=> trans('messages.You have received a new chat from : ') . authUser()->full_name . trans('messages.,at:') . $visit->visit_time_doctor,
                'visit_id'=>$visit->id,
                'reservation'=>$reservation

            ];
            $type='New Visit Chat';
            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
            return  $visit;
        }

    }

    
}
