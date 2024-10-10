<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Modules\Notification\Entities\Notification;
use Modules\Auth\Entities\User;
use Mpdf\Mpdf;
use Modules\Time\Traits\TimeTrait;
use Modules\Reservation\Traits\ReservationTrait;
use Carbon\Carbon;
use Modules\Day\Entities\Day;
use Modules\Movement\Entities\Movement;


trait GeneralMethodsTrait{
    use AuthTrait,TimeTrait,ReservationTrait;
    public function queryGet($model,$lang){
        if($this->checkIsDoctor(authUser()->id)) return $model->where(['doctor_id'=>authUser()->id,'main_lang'=>$lang]);
        else return $model->where(['user_id'=>authUser()->id,'main_lang'=>$lang]);
    }
    public function updateFcmMethod($request){
        $data=$request->validated();
        $user = User::where('id',authUser()->id)->first();
        $user->update(['fcm_token'=>$data['fcm_token']]);
        return $user;
    }

    public function getSlots($doctor,$appointmentDayDoctor,$formattedNextDate){
        $formattedDay=Carbon::parse($formattedNextDate);
        $slots = $this->getAvailableTimeSlots($appointmentDayDoctor->start_time, $appointmentDayDoctor->end_time, 30);
        // if(!$slots){
        //     return    $this->nextAvailability($doctor);
        // }
        $availableSlots = array();
        $availSlots=array();//empty it , and  push in it only slot greater than now
        $stott=[];
        foreach($slots as $slot){
            $slot_start_time = $slot['start_time'];//7:00
            $slot_end_time = $slot['end_time'];//7:30
            $reservationBetweenSlots = $this->getReservationQueryBetween($doctor,$formattedNextDate,$slot_start_time,$slot_end_time)->where('status','1')->first();
            if(!$reservationBetweenSlots){
                if($formattedNextDate == Carbon::now()->format('Y-m-d')){
                    if($slot['start_time'] >  Carbon::now()->format('H:i')){
                        array_push($availableSlots,$slot);

                    }
                }else{
                    array_push($availableSlots,$slot);
                }
            }


        }
        //dd($availableSlots);
        return $availableSlots;
    }
    public function DayAr($Day){
         $formattedDay=$Day->format('l');
        $arformattedDay = trans('modules/days/seeders.'.$formattedDay);
        return $arformattedDay;
    }
    public function DayEn($Day){
        $formattedDay=$Day->format('l');
       $enformattedDay = trans('modules/days/seeders.'.$formattedDay);
       return $enformattedDay;
   }
    public function getDay($doctor,$Day){
        //get day id this day
        $day = Day::where('name',$this->DayAr($Day))->first();
        // get the appointment in same day (today)
        return $doctor->appointments()->where(['active'=>1,'day_id'=>$day->id])->first();

    }
    private function validateDoctorTimeSlots($doctor){

       return $doctor->appointments()->where(['active'=>1])->count();

    }
    public  function nextAvailability($doctor){
        $Date = Carbon::now();//get the current date
        $Day=Carbon::today();
        $checkDay=1;
        $availableSlots=null;
        $result=null;
        if($this->validateDoctorTimeSlots($doctor)==0){
            $checkDay=0;
        }
        if($checkDay==1)  $result = $this->getDay($doctor,$Day);
        while($checkDay){
            if(!$result){
                $Day=$Day->addDay();
                $result = $this->getDay($doctor,$Day);
            }else{
                if($this->getSlots($doctor,$result,$Day->format('Y-m-d'))) $checkDay=0;

                else $Day->addDay();
            }
        }

        if($this->validateDoctorTimeSlots($doctor)) $availableSlots = $this->getSlots($doctor,$result,$Day->format('Y-m-d'));
        if(!$availableSlots || !$result){
            $availableSlots[0]['start_time']=null;
            $availableSlots[0]['end_time']=null;
        }
        $availableSlots[0]['date']=$Day->format('Y-m-d');
        $availableSlots[0]['day']=$this->DayAr($Day);
        return $availableSlots[0];//day,start,endtime

    }

    public  function countMovements($walletId){

        return  Movement::where('wallet_id',$walletId)->count();
    }

    public function diffDuration($time){
       // $time = Carbon::parse('2023-11-05 19:39:15');
        $currentTime = Carbon::now(); 
        $diffInSeconds = $currentTime->diffInSeconds($time);
        return $diffInSeconds;



    }

    function timeToSeconds($time) {     // Split the time into parts
            $parts = array_reverse(explode(':', $time)); // Reverse to ensure seconds are first  
               $seconds = 0;   
                 $multipliers = [1, 60, 3600]; // Multipliers for seconds, minutes, and hours  
                    foreach ($parts as $index => $part) {      
                           if (isset($multipliers[$index])) {        
                                 $seconds += intval($part) * $multipliers[$index];      
                                   }     
                                }    
                                    return $seconds; 
                                }
   
}
