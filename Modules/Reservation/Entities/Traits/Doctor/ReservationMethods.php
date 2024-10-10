<?php
namespace Modules\Reservation\Entities\Traits\Doctor;
// use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\User;
use Modules\Appointment\Entities\Appointment;
use Modules\Reservation\Entities\Prescription;
use Modules\Reservation\Entities\Other;
use Modules\VisitCall\Entities\VisitCall;
use Modules\Reservation\Traits\ReservationTrait;
use Modules\Reservation\Entities\ReservationLog;
use GeneralTrait;
use Modules\Wallet\Entities\Wallet;
use Modules\Day\Entities\Day;
use Illuminate\Support\Facades\Validator;
use Modules\Wallet\Entities\Traits\Doctor\WalletMethods;
use SendingNotificationsService;
use App\Services\SendingMessagesService;

use GeneratePdfService;
use Modules\Movement\Traits\MovementTrait;
use Modules\Wallet\Traits\Doctor\WalletTrait;
use Carbon\Carbon;
use DB;

trait ReservationMethods{

    use GeneralTrait,ReservationTrait,WalletMethods,MovementTrait,WalletTrait;
  public function allReservationsUserPaginates($userId , $request, $model){
        $checkUser = $this->checkIsUser($userId);
        if(is_string($checkUser) || is_numeric($checkUser)){
            return $checkUser;
        }
        return $model->where(['user_id'=>$userId])->paginate($request->total);
    }
    //get data -all- //
    public function allReservationsUserData($userId , $request, $model){
        $checkUser = $this->checkIsUser($userId);
        if(is_string($checkUser) || is_numeric($checkUser)){
            return $checkUser;
        }
        return $model->where(['user_id'=>$userId])->get();
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
    //show an reservation
    public function showMethod($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($item->doctor_id !== authUser()->id) return trans('messages.This reservation not for you to see it');
        return $item->load(['appointment','communication.image','payment','reasonRescheduling','reasonCancelation']);
    }
    public function addNotesMethod($request,$model,$id){//model:reservation

        $data = $request->json()->all();
        $enteredData = exceptData($data,['prescriptions']);

        $doctor=authUser();
        $reservation =  $this->find($model,$id,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->doctor_id!==$doctor->id) return trans('messages.you havent this reservation to add your notes on it');
        if($reservation->is_start=='0') return trans('messages.You cannt add your notes in this reservation , because this reservation until now not start');
        if($reservation->is_end=='1') return trans('messages.You cannt add your notes in this reservation , because this reservation has been finished');
        if($reservation->status=='-1') return trans('messages.You cannt add your notes in this reservation , because until now not pay');
        if($reservation->status=='0') return trans('messages.You cannt add your notes in this reservation , because it is canceled');
        $reservation->update(['notes'=>$enteredData['notes'],'report'=>$enteredData['report'],'message'=>$enteredData['message']]);
        $prescriptions = $data['prescriptions'];
        //search if this the first notes on this reservation , to make a link for this reservation user
        if(count($reservation->prescriptions)==0){
            $fileName = 'Prescription Reservation #'.$reservation->id . '__' . $reservation->doctor->full_name . $reservation->doctor->last_name;
            $link = encryptString($fileName);
            $reservation->update(['link'=>$link,'filename'=>$fileName]);
        }
        // Access prescriptions details
        $reservation->prescriptions()->createMany($prescriptions);
        //end this reservation
        $reservation->update(['is_end'=>'1']);
        $dataNotification = [
            'title'=> trans('messages.Visit End'),
            'body'=> trans('messages.Visit Ended from : ') . authUser()->full_name,
            'reservation'=>$reservation,
            'doctor_name'=>authUser()->full_name,
            'doctor_image'=>authUser()->image,
        ];
        $type='Visit End';
        app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
        //add price this reservation into wallet doctor
        $price = $reservation->price;
        $model2=new Wallet();
        $this->addIntoWallet($model2,$price,$reservation->doctor->id,$reservation->id);

        return $reservation->load('prescriptions');

    }
    public function updateMethod($data,$model,$id){
        $reservation = $this->find($model,$id,'id');
        if(is_numeric($reservation)) return 404;

         $day = dateToDay($data['date']);
         $enteredDay = Day::where('id',$data['day_id'])->first();
         $doctor = User::where('id',$reservation->doctor->id)->first();
         if(!$doctor->profile->price_half_hour) return trans('messages.You cannt reservation with this doctor , because until now he not put her price');

         //check if this reservation for this user
         if($reservation->doctor_id !== authUser()->id) return 404;

         //check status this appointment reservation  is upcoming , if no (canceled , compeleted): cannt edit it
    //     if($reservation->is_end=='1') return $reservation->update(['status'=>'1']);
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
                $message = authUser()->full_name;
                $data=[
                    'email'=>$reservation->user->email,
                    'type'=>'rescheduling-reservation',
                    'user'=>$reservation->user->full_name,
                    'doctor'=>$reservation->doctor->full_name,
                    'reservation_date'=>$reservation->date,
                    'reservation_start_time'=>$reservation->start_time,
                    'reservation_end_time'=>$reservation->end_time,
                    'old_reservation_start_time'=>$reservation_log->start_time,
                    'old_reservation_end_time'=>$reservation_log->end_time,
                    'old_reservation_date'=>$reservation_log->date,
                    'role'=>'doctor'
                ];
                app(SendingMessagesService::class)->sendingMessage($data);
            }
            else{
                //create log for this reservation before update it
                $reservation_log = new ReservationLog();
                $reservation_log = $reservation_log->createReservationLog($reservation);

                $reservation->update(['date'=>$data['date'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time'],'appointment_id'=>$resultAppointmentsDoctor->id,'price'=>$reservation->price]);

                // if(empty($data['reason'])) return trans('messages.You must select or fill reason reschulaing the reservation');
                // else{
                //     $reservation->update(['reason_rescheduling_id'=>$data['reason_id'],'date'=>$data['date'],'start_time'=>$data['start_time'],'end_time'=>$data['end_time'],'appointment_id'=>$resultAppointmentsDoctor->id,'price'=>$reservation->price]);
                //     //delete all reservations that not pay in this time reservation updating
                //     $this->deleteAllReservationsNotPay($reservation->id,$resultAppointmentsDoctor->id,$data['start_time'],$data['end_time'],$data['date']);

                //     Other::insert(['reservation_id'=>$reservation->id,'reason'=>$data['reason'],'type'=>1]);//0: reason cancelation , 1:reason reschualing
                // }
                //send to email
                $message = authUser()->full_name;
                $data=[
                    'email'=>$reservation->user->email,
                    'type'=>'rescheduling-reservation',
                    'user'=>$reservation->user->full_name,
                    'doctor'=>$reservation->doctor->full_name,
                    'reservation_date'=>$reservation->date,
                    'reservation_start_time'=>$reservation->start_time,
                    'reservation_end_time'=>$reservation->end_time,
                    'old_reservation_start_time'=>$reservation_log->start_time,
                    'old_reservation_end_time'=>$reservation_log->end_time,
                    'old_reservation_date'=>$reservation_log->date,
                    'role'=>'doctor'
                ];
                app(SendingMessagesService::class)->sendingMessage($data);
            }

            return $reservation->load(['appointment','communication','payment','reasonRescheduling','visitChat','visitCall']);




    }

    public function updateNotesMethod($request,$model,$id){//model:reservation
        $data = $request->json()->all();
        $enteredData = exceptData($data,['prescriptions']);

        $doctor=authUser();
        $reservation =  $this->find($model,$id,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->doctor_id!==$doctor->id) return trans('messages.you havent this reservation to add your notes on it');
        $reservation->update(['notes'=>$enteredData['notes'],'report'=>$enteredData['report'],'message'=>$enteredData['message']]);
        $prescriptions = $data['prescriptions'];
        // Access prescriptions details
        $reservation->prescriptions()->delete();
        $reservation->prescriptions()->createMany($prescriptions);

        return $reservation->load('prescriptions');

    }

    public function switchVisitMethod($reservationId,$model1,$model2){//model1:reservation , model2:wallet
        $reservation = $model1->where('id',$reservationId)->first();
        if(!$reservation) return 404;
        //check if this reservation for this doctor : prevent visit it for another doctor
        if($reservation->doctor_id !== authUser()->id) return trans('messages.you cannt enter into  this reservation , because you havent it');
        //check if exist another reservation still starting not end with this doctor : if yes -> cannt start this reservation , because found another reservation with him still starting not end
        $countReservationsNotEnd = $model1->where('doctor_id',$reservation->doctor_id)->where('id','!=',$reservationId)->where(['is_end'=>'0','is_start'=>'1'])->count();
       // dd($countReservationsNotEnd);
        if($countReservationsNotEnd !=0){
            return trans('messages.You cannt start this reservation , because you have another reservation still starting');
        }
        //check this reservation just status : paid to enter here
        if($reservation->status == '-1') return trans('messages.this reservation not paid until now , so you cannt enter into it');
        if($reservation->status == '0') return trans('messages.this reservation canceled , so you cannt enter into it');
        if(type()=='start'){
            if($reservation->status == '-1'){
                return trans('messages.this reservation not pay until now , so you cannt start it');
            }
            if($reservation->is_start == '1'){
                return trans('messages.this reservation already has been started');
            }
           $reservation->update(['is_start'=>'1']);
             //change start_time , end_time , date this reservation
             $this->changeTimeReservation($reservation);
            $dataNotification = [
                'title'=> trans('messages.Visit Start'),
                'body'=> trans('messages.Visit Started from : ') . authUser()->full_name,
                'reservation'=>$reservation,
                'doctor_name'=>authUser()->full_name,
                'doctor_image'=>authUser()->image,
            ];
            $type='Visit Start';
            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
        }
        // if(type()=='end'){
        //     if($reservation->status == '-1'){
        //         return trans('messages.this reservation not pay until now , so you cannt end it');
        //     }
        //     if($reservation->is_start== '0'){
        //         return trans('messages.this reservation not start until now , so you cannt end it before start it');
        //     }
        //     if($reservation->is_end == '1'){
        //         return trans('messages.this reservation already has been ended');
        //     }
        //     $reservation->update(['is_end'=>'1']);

        //     $dataNotification = [
        //         'title'=> trans('messages.Visit End'),
        //         'body'=> trans('messages.Visit Ended from : ') . authUser()->full_name,
        //         'reservation'=>$reservation,
        //         'doctor_name'=>authUser()->full_name,
        //         'doctor_image'=>authUser()->image,
        //     ];
        //     $type='Visit End';
        //     app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
        //     //add price this reservation into wallet doctor
        //     $price = $reservation->price;
        //     $this->addIntoWallet($model2,$price,$reservation->doctor->id,$reservation->id);


        // }


        return $reservation->load(['appointment' => function ($query) {
                                $query->withTrashed();
                            }]);

    }
    public function checkVisitMethod($reservationId,$model){
        $reservation = $model->where('id',$reservationId)->first();
        if(!$reservation) return 404;
        //check if this reservation for this doctor : prevent visti it for another doctor
        if($reservation->doctor_id !== authUser()->id) return trans('messages.you cannt enter into  this reservation , because you havent it');
        $data=[
            'is_start'=>$reservation->is_start,
            'is_end'=>$reservation->is_end,
            'current_time'=>setTimeZone(now())

        ];
        return $data;

    }
    public function reportReservationsMethod($request,$model,$doctorId)
    {
        $validator = Validator::make($request->all(), [
            'month' => ['required', 'date_format:m'],
            'year' => ['required', 'numeric', 'digits:4'],

        ]);

        if ($validator->fails()) {
            // handle validation errors
            return abort(404);
        }
        $month = $request['month'];
        $year = $request['year'];
        $doctor = User::where('id',$doctorId)->first();
        if(!$doctor) return abort(404);
        $roleDoctor= $doctor->hasRole('doctor');
        if(!$roleDoctor) return 404;

        // $reservations = $model->where('doctor_id',$doctorId)
        //                     ->where('status','!=','-1')
        //                     ->where('is_end','1')
        //                     ->whereMonth('date', $month)
        //                     ->whereYear('date', $year)
        //                     ->with(['appointment','communication','payment','reasonRescheduling','user'])
        //                     ->orderBy('date','asc')
        //                     ->get();

        $reservations = DB::table('reservation_invoices_details')
            ->select('*',DB::raw('YEAR(date) year, MONTH(date) month'))
             ->whereRaw('MONTH(date) = '.$month)
            ->whereRaw('YEAR(date) = '.$year)
            ->where('doctor_id',$doctorId)->get();

        $doctorPresentageSum = $reservations->sum('doctor_presentage');
        $talbinahPresentageSum = $reservations->sum('Talbinah_presentage');
        $priceSum = $reservations->sum('price');

        $view='invoices.doctor.reservations';
        $data=['reservations' => $reservations,'reservations_count'=>count($reservations),'doctor'=>$doctor,'priceSum'=>$priceSum,'talbinahPresentageSum'=>$talbinahPresentageSum,'doctorPresentageSum'=>$doctorPresentageSum];
        $fileName = 'Reservations_'.$doctor->full_name.'Month:'. $month .' ' .'Year:'. ' '. $year.'.pdf';
        return app(GeneratePdfService::class)->renderPdf($view,$data,$fileName);
    }

    public function reportYearReservationsMethod($request,$model){
        $validator = Validator::make($request->all(), [
            'year' => ['nullable','numeric', 'digits:4'],
        ]);
        if ($validator->fails()) {
            // handle validation errors
            return 404;
        }
        $year = $request['year'];
        $doctor=authUser();
        $reservationsYear = $model->where('doctor_id',$doctor->id)
                                    ->where('status','!=','-1')
                                    ->where('is_end','1')
                                    ->with(['appointment','communication','payment','reasonRescheduling','user'])
                                    ->orderBy('date','asc')
                                    ->get();
        if(!$year){
            //get all months for this doctor in this year
            $monthsYearReservations = [];
            foreach($reservationsYear as $reservation){
                $yearMonth = \Carbon\Carbon::parse($reservation->date)->year;
                $carbonDate = \Carbon\Carbon::parse($reservation->date);
                $month = $carbonDate->month;
                if(!in_array($month,$monthsYearReservations)) array_push($monthsYearReservations,$month);

            }
            return $monthsYearReservations;

        }


        $reservationsYear = $model->where('doctor_id',$doctor->id)
                            ->where('status','!=','-1')
                            ->where('is_end','1')
                            ->whereYear('date', $year)
                            ->with(['appointment','communication','payment','reasonRescheduling','user'])
                            ->orderBy('date','asc')
                            ->get();
        $monthsYearReservations = [];
        foreach($reservationsYear as $reservation){
            $carbonDate = \Carbon\Carbon::parse($reservation->date);
            $month = $carbonDate->month;
            if(!in_array($month,$monthsYearReservations))  array_push($monthsYearReservations,$month);

        }
        return $monthsYearReservations;

    }

    public function randomLinkMethod($model){
        $linkRandom = randomLink();
        $reservation = $model->where('link',$linkRandom)->first();
        if(!$reservation) return abort(404);
        return redirect(route('reservations.invoice',$reservation->id));
    }

    public function cancelMethod($id,$model1,$model2){//model1:reservation , model2: wallet
        $reservation = $this->find($model1,$id,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->doctor_id !== authUser()->id) return 404;
        if($reservation->status == '0') return trans('messages.This is reservation already canceled');
        if($reservation->is_end == '1') return trans('messages.this reservation has been ended');
        //will take from wallet doctor share talbinah
        $walletDoctor=Wallet::where(['user_id'=>$reservation->doctor_id])->first();
       
        if($walletDoctor->balance < calShareTalbinah($reservation->price)) return trans('messages.you havent enough balance to cancel this reservation');
        $walletDoctor->balance = $walletDoctor->balance - calShareTalbinah($reservation->price);
        $walletDoctor->save();
        
         //add a movement
         $nameMovement = trans('messages.withdraw from wallet via cancelation reservation');
         $typeMovement = '-1';//withdrawing
         $role = 'doctor';
         $this->createMovement($model2,calShareTalbinah($reservation->price),$reservation->doctor_id,$nameMovement,$typeMovement,$role,$reservation->id);

        //will return price this reservation into balance wallet user
        $walletUser=Wallet::where(['user_id'=>$reservation->user_id])->first();
        if(empty($walletUser)){
           $walletUser=new Wallet();
           $walletUser->user_id=$reservation->user_id;
           $walletUser->balance = $walletUser->balance + $reservation->price;
           $walletUser->save();
        }
        $walletUser->balance = $walletUser->balance + $reservation->price;
        $walletUser->save();


         //add a movement
         $nameMovement = trans('messages.adding into wallet via cancelation reservation');
         $typeMovement = '1';//Deposition
         $role = 'doctor';
         $this->createMovement($model2,$reservation->price,$reservation->user_id,$nameMovement,$typeMovement,$role,$reservation->id);

        $reservation->update(['status'=>'0']);

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
             'email'=>$reservation->user->email,
             'type'=>'cancel-reservation',
             'user'=>$reservation->user->full_name,
             'doctor'=>$reservation->doctor->full_name,
             'reservation_date'=>$reservation->date,
             'reservation_start_time'=>$reservation->start_time,
             'reservation_end_time'=>$reservation->end_time,
             'role'=>'doctor'
         ];
         app(SendingMessagesService::class)->sendingMessage($data);

        return $reservation->load(['appointment','communication','payment','reasonCancelation']);
    }
    public function checkReservationMethod($reservationId,$model){
        $reservation = $this->find($model,$reservationId,'id');
        if(is_numeric($reservation)) return 404;
        if($reservation->doctor_id !== authUser()->id) return 404;
        if($reservation->is_start == '0') return trans('messages.this reservation not start until now');
        elseif($reservation->is_end == '1') return trans('messages.this reservation has been ended');
        else{
            if(!$reservation->visitCall){
                //if no : add it
                $data['doctor_id']=authUser()->id;
                $data['reservation_id']=$reservation->id;
                $data['visit_time_doctor']=now();
                $visit = VisitCall::create($data);
                //change start_time , end_time , date this reservation
                $this->changeTimeReservation($reservation);
                $dataNotification = [
                    'title'=> trans('messages.New Voice Call'),
                    'body'=> trans('messages.You have received a new voice call from : ') . authUser()->full_name . trans('messages.,at:') . $visit->visit_time_doctor,
                    'visit_id'=>$visit->id,
                    'reservation'=>$reservation,
                    'doctor_name'=>authUser()->full_name,
                    'doctor_image'=>authUser()->image,


                ];
                $type='New Visit Call';
                app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
                return  $reservation;
            }else{

                $doctorEntryTime = Carbon::parse($reservation->visitCall->visit_time_doctor);
                if($this->remainingTimeReservation($doctorEntryTime,$reservation->duration->duration) <= 0){
                    return trans('messages.this reservation has been ended');
                }else{//if diff < duartion ->will allow user visit
                    //add doctor_visit_call_time and send notification to user (just first time)

                        //check if this reservation exist in table visits : get this col. to know if visited it from a user or a doctor
                        $visitReservation = VisitCall::where(['reservation_id'=>$reservationId])->first();

                        $doctor = User::where('id',$reservation->doctor_id)->first();
                        //if  vistied it from a user will update on it to add this doctor in this col. and visit_time
                        //if vistied it from a doctor : cannt add it again or update on it
                        if($visitReservation){
                            if($visitReservation->user_id!=null){
                                if($visitReservation->doctor_id!==null){
                                    return $reservation;
                                }else{
                                    $visitReservation->doctor_id=$doctor->id;
                                    $visitReservation->visit_time_doctor=now();
                                    $visitReservation->save();
                                    //change start_time , end_time , date this reservation
                                    $this->changeTimeReservation($reservation);
                                    $dataNotification = [

                                        'title'=> trans('messages.New Voice Call'),
                                        'body'=> trans('messages.You have received a new voice call from : ') . authUser()->full_name . trans('messages.,at:') . $visitReservation->visit_time_doctor,
                                        'visit_id'=>$visitReservation->id,
                                        'reservation'=>$reservation,
                                        'doctor_name'=>authUser()->full_name,
                                        'doctor_image'=>authUser()->image,

                                    ];
                                    $type = 'New Visit Call';
                                    app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);

                                    return $reservation;

                                }
                            }else{

                                return $reservation;
                            }

                        }else{
                            //if no : add it
                            $data['doctor_id']=authUser()->id;
                            $data['reservation_id']=$reservation->id;
                            $data['visit_time_doctor']=now();
                            $visit = VisitCall::create($data);
                            //change start_time , end_time , date this reservation
                            $this->changeTimeReservation($reservation);
                            $dataNotification = [
                                'title'=> trans('messages.New Voice Call'),
                                'body'=> trans('messages.You have received a new voice call from : ') . authUser()->full_name . trans('messages.,at:') . $visit->visit_time_doctor,
                                'visit_id'=>$visit->id,
                                'reservation'=>$reservation,
                                'doctor_name'=>authUser()->full_name,
                                'doctor_image'=>authUser()->image,


                            ];
                            $type='New Visit Call';
                            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->user_id,$type);
                            return  $reservation;
                        }
                    }

            }
        }
    }
}
