<?php

use Modules\Review\Entities\Review;
use Modules\Favorite\Entities\Favorite;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Reservation\Entities\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

function urlDomain(){
    return 'http://127.0.0.1:8000/';
}
function encryptString($string){
    return hash('md5', $string);
}

function avgRatingReview($doctorId){
    $averageRating = Review::where('doctor_id', $doctorId)
                        ->avg('rating');
    return round($averageRating,3);
}
function countReservationsDoctor($doctorId){
    $countReservationsDoctor = Reservation::where(['doctor_id'=> $doctorId,'status'=>'1'])->count();
    return $countReservationsDoctor;
}

///////////////////
// function nextAvailability($doctor){
//     //get all appointments this doctor , and get nearest appointment doctor
//     $now = Carbon::now();
//     $nextAvai = $doctor->appointments()
//                 ->where('day_id', '>', $now->dayOfWeek)
//                 ->where(function ($query) use ($now) {
//                     $query->where('start_time', '>', $now->toTimeString())
//                         ->orWhere(function ($query) use ($now) {
//                             $query->where('start_time', '=', $now->toTimeString())
//                                 ->where('end_time', '>', $now->toTimeString());
//                         });
//                 })
//                 ->orderBy('day_id', 'asc')
//                 ->first();
//     if($nextAvai) return $nextAvai->load('day');
//     else $nextAvai;

// }

function isFav($doctorId){
    if(authUser()){
        $isFav = Favorite::where(['doctor_id'=> $doctorId,'user_id'=>authUser()->id])->first();
        if($isFav) return true;
        else return false;
    }
}
function isBookmark($articleId){
    if(authUser()){
        $isBookmark = Bookmark::where(['article_id'=> $articleId,'user_id'=>authUser()->id])->first();
        if($isBookmark) return true;
        else return false;
    }
}

function revenuesDoctor($doctor){
    $reservationsDoctorCount = Reservation::where(['doctor_id'=>$doctor->id,'is_end'=>'1'])->count();
    if($doctor->profile)  return $doctor->profile->price_half_hour * $reservationsDoctorCount;
}
function revenuesDoctorReservations($doctor,$reservationsDoctor){
    $reservationsDoctorCount = $reservationsDoctor->count();
    if($doctor->profile)  return $doctor->profile->price_half_hour * $reservationsDoctorCount;
}
function priceHalfHour($doctor){
   return  $doctor->profile->price_half_hour;
}

function calShareDoctor($price){
  return  $price * config('vars.share_doctor')/100;
}

function calShareTalbinah($price){
    return  $price * config('vars.share_talbinah')/100;
  }

function precentageTalbinah($price){
    return  $price * config('vars.precentage_talbinah')/100;
}
function calPaymentPrice($priceHalfHour,$duration){
   return ($priceHalfHour*2)*$duration;
}



function setTimeZone($utc){
    $dt = new DateTime($utc);
    $tz = new DateTimeZone(config('app.timezone')); // or whatever zone you're after

    $dt->setTimezone($tz);
    return $dt->format('Y-m-d H:i:s');
}
function dateToDay($date) {
    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
    $dayOfWeek = $carbonDate->locale('ar')->isoFormat('dddd');

    return $dayOfWeek;
}
function querySearch($search){
    when($search, function($query) use($search){
        if(is_numeric($search)){
            return    $query->where('id','like', '%' . $search .  '%');
        }else{
        //  return    $query->where('id','%LIKE%',$search);

            $searchedReservations = collect($reservations->items())->filter(function ($reservation) use ($search) {
                                                                return strpos($reservation->doctor->full_name, $search) !== false;

                                                            })->values()->all();
            return  $searchedReservations;
        }
    })->query();


}

function countReports($doctor){
    $reservations = Reservation::where('doctor_id',$doctor->id)
                                ->where('status','!=','-1')
                                ->where('is_end','1')
                                ->with(['appointment','communication','payment','reasonRescheduling','user'])
                                ->orderBy('date','asc')
                                ->get();
    //get all months for this doctor , but if this month exist in this year
    //هاتلي كل الاشهر اللي بالحجوزات لكن ما تبشلي الشهر اللي بكون بالسنة الوحدة اكتر من مرة
    $monthsYearsReservations = [];
    $yearsReservations = [];
    foreach($reservations as $reservation){
        $dateReservation = \Carbon\Carbon::parse($reservation->date)->month;
        $yearReservation = \Carbon\Carbon::parse($reservation->date)->year;
        $monthYearReservation = $dateReservation . '/' . $yearReservation;
        if(!in_array($monthYearReservation,$monthsYearsReservations))  array_push($monthsYearsReservations,$monthYearReservation);
    }
    return count($monthsYearsReservations);
}


    
