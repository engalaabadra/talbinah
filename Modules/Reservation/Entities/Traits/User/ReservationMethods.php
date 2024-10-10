<?php
namespace Modules\Reservation\Entities\Traits\User;
use App\Services\UploadService;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Appointment\Entities\Appointment;
use Modules\Duration\Entities\Duration;
use Modules\Day\Entities\Day;
use Modules\Reservation\Entities\Other;
use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Traits\ReservationTrait;
use Modules\Wallet\Entities\Wallet;
use PDF;
use SendingNotificationsService;
use GeneratePdfService;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\Movement\Traits\MovementTrait;
use Modules\Wallet\Entities\Traits\User\WalletMethods;
use Modules\Wallet\Traits\User\WalletTrait;
use Modules\Reservation\Entities\ReservationLog;
use Modules\VisitCall\Entities\VisitCall;

use App\Services\SendingMessagesService;
use Carbon\Carbon;


trait ReservationMethods{
    use ReservationTrait,WalletMethods,MovementTrait, GeneralTrait,WalletTrait;



    //show an reservation
    public function showMethod($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($item->user_id !== authUser()->id) return trans('messages.This reservation not for you to see it');
        return $item->load(['communication.image','payment','reasonCancelation','appointment' => function ($query) {
            $query->withTrashed();
        }]);
    }
    //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))   return $this->paginatesDataMethod($request, $model,search(),getallheaders()['lang']);
        else  return $this->paginatesDataMethod($request, $model,search());

    }
    public function paginatesDataMethod($request, $model,$search,$lang=null){
        if(!$lang) $lang=localLang();
        $query =  $this->queryGet($model,$lang)->where('status','!=','-1')->orderBy('date','asc');
        return $this->querySearchReservation($query,$search)->paginate($request->total);
    }

    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,search(),getallheaders()['lang']);
        else return $this->allDataMethod($model,search());

    }
    public function allDataMethod($model,$search,$lang=null){
        if(!$lang) $lang=localLang();
        $query =  $this->queryGet($model,$lang)->orderBy('date','asc');
        return $this->querySearchReservation($query,$search)->get();
    }

    //filter//
    //pagination
    public function getPaginatesDataFilterMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataFilterMethod($request, $model,search(),getallheaders()['lang']);
        else return $this->paginatesDataFilterMethod($request, $model,search());
    }
    public function paginatesDataFilterMethod($request, $model,$search,$lang=null){
        if(!$lang) $lang=localLang();
        $status=status();
        $start=isStart();
        $end=isEnd();
        if(($start || $start =="0" )&&($end || $end =="0" )&&($status || $status =="0" )){
            $query = $this->queryGet($model,$lang)->where('is_start',$start)->where('is_end',$end)->where('status',$status)->orderBy('date','asc');
            return $this->querySearchReservation($query,$search)->paginate($request->total);
        }else{
            if(($start || $start =="0")&&($end || $end =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_start',$start)->where('is_end',$end)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }elseif(($start || $start =="0")&&($status || $status =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_start',$start)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }elseif(($end || $end =="0")&&($status || $status =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_end',$end)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }elseif($start || $start =="0" ){
                $query =  $this->queryGet($model,$lang)->where('is_start',$start)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }elseif($end || $end =="0"){
                $query =  $this->queryGet($model,$lang)->where('is_end',$end)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }elseif($status || $status =="0"){
                $query =  $this->queryGet($model,$lang)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->paginate($request->total);

            }
        }
    }
    //get data -all- //
    public function getAllDataFilterMethod($model){
    if(isset(getallheaders()['lang']))  return $this->allDataFilterMethod($model,search(),getallheaders()['lang']);
        else return $this->allDataFilterMethod($model,search());
    }
    public function allDataFilterMethod($model,$search,$lang=null){
        if(!$lang) $lang=localLang();
        $status=status();
        $start=isStart();
        $end=isEnd();
        if(($start || $start =="0" )&&($end || $end =="0" )&&($status || $status =="0" )){
            $query =  $this->queryGet($model,$lang)->where('is_start',$start)->where('is_end',$end)->where('status',$status)->orderBy('date','asc');
            return $this->querySearchReservation($query,$search)->get();

        }else{
            if(($start || $start =="0")&&($end || $end =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_start',$start)->where('is_end',$end)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();

            }elseif(($start || $start =="0")&&($status || $status =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_start',$start)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();

            }elseif(($end || $end =="0")&&($status || $status =="0" ) ){
                $query =  $this->queryGet($model,$lang)->where('is_end',$end)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();

            }elseif($start || $start =="0" ){
                $query = $this->queryGet($model,$lang)->where('is_start',$start)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();
            }elseif($end || $end =="0"){
                $query =  $this->queryGet($model,$lang)->where('is_end',$end)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();

            }elseif($status || $status =="0"){
                $query =  $this->queryGet($model,$lang)->where('status',$status)->orderBy('date','asc');
                return $this->querySearchReservation($query,$search)->get();

            }
        }
    }
    public function storeReservation($data,$model){
        $day = dateToDay($data['date']);
        $enteredDay = Day::where('id',$data['day_id'])->first();
        if($day!=$enteredDay->name) return trans('messages.the day that you entered it , non-compatible with entered date');
        //check if this user make a reservation with a doctor
        $resultCheckIsDoctor = $this->checkIsDoctor($data['doctor_id']);
        if(is_string($resultCheckIsDoctor) || is_numeric($resultCheckIsDoctor)) return $resultCheckIsDoctor;
        //check if this doctor put her price in his profile or not
        $doctor = User::where('id',$data['doctor_id'])->first();
        if(!$doctor->profile || !$doctor->profile->price_half_hour) return trans('messages.You cannt reservation with this doctor , because until now he not put her price');
        //check if this time,day exist in appointments this doctor
        $resultAppointmentsDoctor = $this->checkAppointmentsDoctor($data['doctor_id'],$data['start_time'],$data['end_time'],$data['day_id'],$data['duration_id']);
        if(is_string($resultAppointmentsDoctor) || is_numeric($resultAppointmentsDoctor)) return $resultAppointmentsDoctor;

        //check if this appointment not reserve from another patient with this doctor or not reseve form this user also
        /*** proccess */
        $resultCheckReservationsPatient = $this->checkReservationsPatient($model,$data,$resultAppointmentsDoctor->id,$doctor);
        if(is_string($resultCheckReservationsPatient)) return $resultCheckReservationsPatient;

        //Check payment result , if false -> will resturn a message , if true -> will store this payment into this reservation
        $enteredData = exceptData($data,['day_id']);
        $enteredData['appointment_id']=$resultAppointmentsDoctor->id;
        $enteredData['status'] = '-1' ;//pending (add reservation but not pay)
        $priceHalfHour = priceHalfHour($doctor);
        if($enteredData['duration_id']==1) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=0.25);//a quarter hour
        if($enteredData['duration_id']==2) $enteredData['price']= $priceHalfHour;//a half hour
        if($enteredData['duration_id']==3) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=0.75);//quarter hour
        if($enteredData['duration_id']==4) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=1);//an hour
        $reservation = $model->create($enteredData);
        if($data['payment_id'] == 1){//pay via wallet
            //will decrease balance wallet this user
            $wallet=Wallet::where(['user_id'=>$reservation->user_id])->first();
            $model2=new Wallet();
            //check if this wallet enough for price reservation
            if($wallet->balance < $reservation->price) return trans('messages.Your balance not enough to make a reservation here');
            $wallet->balance = $wallet->balance - $reservation->price;
            $wallet->save();

            //add a movement
            $nameMovement = trans('messages.withdrawing from wallet via adding reservation');
            $typeMovement = '-1';//Withdrawing
            $role = 'user';
            $this->createMovement($model2,$reservation->price,$reservation->user_id,$nameMovement,$typeMovement,$role,$reservation->id);


            $this->paidReservation($doctor,$reservation);
            //send to email doctor
            $data=[
                'email'=>$reservation->doctor->email,
                'type'=>'new-reservation',
                'user'=>$reservation->user->full_name,
                'user_birth_date'=>$reservation->user->profile ? $reservation->user->profile->birth_date : null,
                'doctor'=>$reservation->doctor->full_name,
                'reservation_date'=>$reservation->date,
                'reservation_start_time'=>$reservation->start_time,
                'reservation_end_time'=>$reservation->end_time,
                'reservation_problem'=>$reservation->problem,
                'to'=>'doctor'
            ];
            app(SendingMessagesService::class)->sendingMessage($data);

            //send to email user
            $data=[
                'email'=>$reservation->user->email,
                'type'=>'new-reservation',
                'user'=>$reservation->user->full_name,
                'doctor'=>$reservation->doctor->full_name,
                'reservation_date'=>$reservation->date,
                'reservation_start_time'=>$reservation->start_time,
                'reservation_end_time'=>$reservation->end_time,
                'to'=>'user'
            ];
            app(SendingMessagesService::class)->sendingMessage($data);

        }
        return $reservation;

    }

    public function adminUpdateReservation($data,$model,$id){

        $reservation = $this->find($model,$id,'id');

        //if($reservation->reason_rescheduling_id!=null || $otherReasonReservation!==null) return trans('messages.You make reschualing for this reservation before it');
        $doctor = User::where('id',$reservation->doctor->id)->first();
        if(!$doctor->profile->price_half_hour) return trans('messages.You cannt reservation with this doctor , because until now he not put her price');

        //check if this time,day exist in appointments this doctor
        $resultAppointmentsDoctor = $this->checkAppointmentsDoctor($reservation->doctor_id,$data['start_time'],$data['end_time'],$data['day_id'],$reservation->duration_id);
        if(is_string($resultAppointmentsDoctor) || is_numeric($resultAppointmentsDoctor)) return $resultAppointmentsDoctor;

        //check if this appointment not reserve from another patient with this doctor or not reseve form this user also
        /*** proccess */
        $resultCheckReservationsPatient = $this->checkReservationsPatient($model,$data,$resultAppointmentsDoctor->id,$doctor,$id);
        if(is_string($resultCheckReservationsPatient)) return $resultCheckReservationsPatient;
        unset($data['day_id']);
        $reservation->update($data);
        return 'success';

    }
    public function adminStoreReservation($data,$model){

        $day = dateToDay($data['date']);
        $enteredDay = Day::where('id',$data['day_id'])->first();
        if($day!=$enteredDay->name) return trans('messages.the day that you entered it , non-compatible with entered date');
        //check if this user make a reservation with a doctor
        $resultCheckIsDoctor = $this->checkIsDoctor($data['doctor_id']);
        if(is_string($resultCheckIsDoctor) || is_numeric($resultCheckIsDoctor)) return $resultCheckIsDoctor;
        //check if this doctor put her price in his profile or not
        $doctor = User::where('id',$data['doctor_id'])->first();
        if(!$doctor->profile || !$doctor->profile->price_half_hour) return trans('messages.You cannt reservation with this doctor , because until now he not put her price');
        //check if this time,day exist in appointments this doctor
        $resultAppointmentsDoctor = $this->checkAppointmentsDoctor($data['doctor_id'],$data['start_time'],$data['end_time'],$data['day_id'],$data['duration_id']);
        if(is_string($resultAppointmentsDoctor) || is_numeric($resultAppointmentsDoctor)) return $resultAppointmentsDoctor;

        //check if this appointment not reserve from another patient with this doctor or not reseve form this user also
        /*** proccess */
        $resultCheckReservationsPatient = $this->checkReservationsPatient($model,$data,$resultAppointmentsDoctor->id,$doctor);
        if(is_string($resultCheckReservationsPatient)) return $resultCheckReservationsPatient;

        //Check payment result , if false -> will resturn a message , if true -> will store this payment into this reservation
        $enteredData = exceptData($data,['day_id']);
        $enteredData['appointment_id']=$resultAppointmentsDoctor->id;
        $enteredData['created_by'] = 'admin';
        $priceHalfHour = priceHalfHour($doctor);
        if($enteredData['duration_id']==1) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=0.25);//a quarter hour
        if($enteredData['duration_id']==2) $enteredData['price']= $priceHalfHour;//a half hour
        if($enteredData['duration_id']==3) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=0.75);//quarter hour
        if($enteredData['duration_id']==4) $enteredData['price']= calPaymentPrice($priceHalfHour,$duration=1);//an hour
        $model->create($enteredData);
        return 'success';

    }
    public function actionMethod($request,$model,$id=null){//model:reservation
        $data = $request->validated();
        $user=authUser();
        $data['user_id'] =  $user->id;
        if($id) return $this->updateResevation($data,$model,$id);
        else return $this->storeReservation($data,$model);

    }
    public function cancelMethod($request,$id,$model1,$model2){//model1:reservation , model2:wallet
        $data=$request->validated();
        $reservation = $this->find($model1,$id,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->user_id !== authUser()->id) return 404;
        if($reservation->status == '0') return trans('messages.This is reservation already canceled');
        if($reservation->is_end == '1') return trans('messages.this reservation has been ended');
        if(!empty($data['reason_id'])) $reservation->update(['reason_cancelation_id'=>$data['reason_id'],'status'=>'0']);
        else{
            if(empty($data['reason'])) return trans('messages.You must select or fill reason cancelation the reservation');
            else Other::insert(['reservation_id'=>$reservation->id,'reason'=>$data['reason'],'type'=>0]);//0: reason cancelation , 1:reason reschualing
        }
        $dataNotification = [
            'title'=> trans('messages.Your reservation has been cancelled'),
            'body'=> trans('messages.You have received a new reservation canceled from : ') . authUser()->full_name,
            'reservation'=>$reservation,
            'doctor_name'=>$reservation->doctor->full_name,
            'doctor_image'=>$reservation->doctor->image,
        ];
        $type='New reservation canceled';
        app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->doctor->id,$type);

        //send to email
        $data=[
            'email'=>$reservation->doctor->email,
            'type'=>'cancel-reservation',
            'user'=>$reservation->user->full_name,
            'doctor'=>$reservation->doctor->full_name,
            'reservation_date'=>$reservation->date,
            'reservation_start_time'=>$reservation->start_time,
            'reservation_end_time'=>$reservation->end_time,
            'role'=>'user'
        ];
        app(SendingMessagesService::class)->sendingMessage($data);

        //will return price this reservation into balance wallet user
        $this->addIntoWallet($model2,$reservation->price,$reservation->user->id,$reservation->id);

        return $reservation->load(['appointment','communication','payment','reasonCancelation']);
    }

    public function checkVisitMethod($reservationId,$model){
        $reservation = $model->where('id',$reservationId)->first();
        if(!$reservation) return 404;
        //check if this reservation for this user : prevent visti it for another user
        if($reservation->user_id !== authUser()->id) return trans('messages.you cannt enter into  this reservation , because you havent it');
        $data=[
            'is_start'=>$reservation->is_start,
            'is_end'=>$reservation->is_end,
            'current_time'=>setTimeZone(now())

        ];
        return $data;

    }
    public function notesPdfReservationMethod($reservationId,$model)
    {
        $reservation =  $this->find($model,$reservationId,'id');
        if(is_numeric($reservation)) return abort(404);
        $view='invoices.user.reservation';
        $data= ['reservation' => $reservation->load(['communication','payment','reasonRescheduling','user','appointment'])];
        $fileName = $reservation->filename . '__' .  $reservation->doctor->full_name . $reservation->doctor->last_name .'.pdf';
        return app(GeneratePdfService::class)->renderPdf($view,$data,$fileName);

    }
    public function randomLinkMethod($model){
        $linkRandom = randomLink();
        $reservation = $model->where('link',$linkRandom)->first();
        if(!$reservation) return abort(404);
        return redirect(route('reservations.invoice',$reservation->id));
    }



    public function checkReservationMethod($reservationId,$model){
        $reservation = $this->find($model,$reservationId,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->user_id !== authUser()->id) return 404;
        if($reservation->is_start == '0') return trans('messages.this reservation not start until now');
        elseif($reservation->is_end == '1') return trans('messages.this reservation has been ended');
        elseif(!$reservation->visitCall->visit_time_doctor) return trans('messages.the doctor not enter until now');
        else{
            $doctor = User::where('id',$reservation->doctor_id)->first();
            
                     $doctorEntryTime = Carbon::parse($reservation->visitCall->visit_time_doctor);
                    if($this->remainingTimeReservation($doctorEntryTime,$reservation->duration->duration) <= 0){
                        return trans('messages.this reservation has been ended');
                    }else{//if diff < duartion ->will allow user visit
                        //add user_visit_call_time and send notification to doctor (just first time)

                        //check if this reservation exist in table visits : get this col. to know if visited it from a user or a doctor
                        $visitReservation = VisitCall::where(['reservation_id'=>$reservationId])->first();

                         //if  vistied it from a user will update on it to add this user in this col. and visit_time
                        //if vistied it from a user : cannt add it again or update on it

                        if($visitReservation){
                            if($visitReservation->doctor_id!=null){
                                if($visitReservation->user_id!==null){
                                    return $reservation;
                                }else{
                                    $visitReservation->user_id=authUser()->id;
                                    $visitReservation->visit_time_user=now();
                                    $visitReservation->save();
                                    //change start_time , end_time , date this reservation
                                    $this->changeTimeReservation($reservation);
                                    $dataNotification = [

                                        'title'=> trans('messages.New Voice Call'),
                                        'body'=> trans('messages.You have received a new voice call from : ') . authUser()->full_name . trans('messages.,at:') . $visitReservation->visit_time_user,
                                        'visit_id'=>$visitReservation->id,
                                        'reservation'=>$reservation,
                                        'doctor_name'=>$doctor->full_name,
                                        'doctor_image'=>$doctor->image,

                                    ];
                                    $type = 'New Visit Call';
                                    app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);

                                    return $reservation;

                                }
                            }else{
                                return trans('messages.the doctor not enter until now');
                            }

                        }else{
                            //if no : add it
                            $data['user_id']=authUser()->id;
                            $data['visit_time_user']=now();
                            $data['reservation_id']=$reservation->id;
                            $visit = VisitCall::create($data);
                            //change start_time , end_time , date this reservation
                            $this->changeTimeReservation($reservation);
                            $dataNotification = [
                                'title'=> trans('messages.New Voice Call'),
                                'body'=> trans('messages.You have received a new voice call from : ') . authUser()->full_name . trans('messages.,at:') . $visit->visit_time_user,
                                'visit_id'=>$visit->id,
                                'reservation'=>$reservation,
                                'doctor_name'=>$doctor->full_name,
                                'doctor_image'=>$doctor->image,


                            ];
                            $type='New Visit Call';
                            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
                            return  $reservation;
                        }
                    }

            
        }
    }
    public function updateResevation($data,$model,$id){
        $reservation = $this->find($model,$id,'id');
        if(is_numeric($reservation)) return 404;
        $day = dateToDay($data['date']);
        $enteredDay = Day::where('id',$data['day_id'])->first();
        $otherReasonReservation = Other::where(['reservation_id'=>$id,'type'=>'1'])->first();
        //if($reservation->reason_rescheduling_id!=null || $otherReasonReservation!==null) return trans('messages.You make reschualing for this reservation before it');
        $doctor = User::where('id',$reservation->doctor->id)->first();
        if(!$doctor->profile->price_half_hour) return trans('messages.You cannt reservation with this doctor , because until now he not put her price');

        //check if this reservation for this user
        if($reservation->user_id !== authUser()->id) return 404;

        //check status this appointment reservation  is upcoming , if no (canceled , compeleted): cannt edit it
        // if($reservation->is_end=='1') return trans('messages.this reservation completed , so you cannt update on it');
        if($reservation->status=='0') return trans('messages.this reservation canceled , so you cannt update on it');
        if($reservation->status=='-1') return trans('messages.this reservation not pay until now , so you cannt update on it');
        if($reservation->is_end == '1') return trans('messages.this reservation has been ended');

        //check if this time,day exist in appointments this doctor
        $resultAppointmentsDoctor = $this->checkAppointmentsDoctor($reservation->doctor->id,$data['start_time'],$data['end_time'],$data['day_id'],$reservation->duration->id);
        if(is_string($resultAppointmentsDoctor) || is_numeric($resultAppointmentsDoctor)) return $resultAppointmentsDoctor;


        //check if this appointment not reserve from another patient with this doctor or not reseve form this user also
        /*** proccess */
        $resultCheckReservationsPatient = $this->checkReservationsPatient($model,$data,$resultAppointmentsDoctor->id,$doctor,$id);
        if(is_string($resultCheckReservationsPatient)) return $resultCheckReservationsPatient;

        //Check payment result , if false -> will resturn a message , if true -> will store this payment into this reservation
        $enteredData = exceptData($data,['day_id']);

        if(!empty($data['reason_id'])){
            //create log for this reservation before update it
            $reservation_log = new ReservationLog();
            $reservation_log = $reservation_log->createReservationLog($reservation);

            $reservation->update(['reason_rescheduling_id'=>$data['reason_id'],'date'=>$data['date'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time'],'appointment_id'=>$resultAppointmentsDoctor->id,'price'=>$reservation->price]);
            //delete all reservations that not pay in this time reservation updating
            $this->deleteAllReservationsNotPay($reservation,$resultAppointmentsDoctor->id,$data['start_time'],$data['end_time'],$data['date']);
            //send to email
            $data=[
                'email'=>$reservation->doctor->email,
                'type'=>'rescheduling-reservation',
                'user'=>$reservation->user->full_name,
                'doctor'=>$reservation->doctor->full_name,
                'reservation_date'=>$reservation->date,
                'reservation_start_time'=>$reservation->start_time,
                'reservation_end_time'=>$reservation->end_time,
                'old_reservation_start_time'=>$reservation_log->start_time,
                'old_reservation_end_time'=>$reservation_log->end_time,
                'old_reservation_date'=>$reservation_log->date,
                'role'=>'user'
            ];
            app(SendingMessagesService::class)->sendingMessage($data);

        }
        else{
            if(empty($data['reason'])) return trans('messages.You must select or fill reason reschulaing the reservation');
            else{
                //create log for this reservation before update it
                $reservation_log = new ReservationLog();
                $reservation_log = $reservation_log->createReservationLog($reservation);

                $reservation->update(['reason_rescheduling_id'=>$data['reason_id'],'date'=>$data['date'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time'],'appointment_id'=>$resultAppointmentsDoctor->id,'price'=>$reservation->price]);
                //delete all reservations that not pay in this time reservation updating
                $this->deleteAllReservationsNotPay($reservation,$resultAppointmentsDoctor->id,$data['start_time'],$data['end_time'],$data['date']);

                Other::insert(['reservation_id'=>$reservation->id,'reason'=>$data['reason'],'type'=>1]);//0: reason cancelation , 1:reason reschualing
                //send to email
                $data=[
                    'email'=>$reservation->doctor->email,
                    'type'=>'rescheduling-reservation',
                    'user'=>$reservation->user->full_name,
                    'doctor'=>$reservation->doctor->full_name,
                    'reservation_date'=>$reservation->date,
                    'reservation_start_time'=>$reservation->start_time,
                    'reservation_end_time'=>$reservation->end_time,
                    'old_reservation_start_time'=>$reservation_log->start_time,
                    'old_reservation_end_time'=>$reservation_log->end_time,
                    'old_reservation_date'=>$reservation_log->date,
                    'role'=>'user'
                ];
                app(SendingMessagesService::class)->sendingMessage($data);
            }
        }
        return $reservation->load(['appointment','communication','payment','reasonRescheduling','visitChat','visitCall']);

    }

}
