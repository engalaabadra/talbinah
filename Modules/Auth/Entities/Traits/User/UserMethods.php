<?php
namespace Modules\Auth\Entities\Traits\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Role;
use Modules\Favorite\Entities\Favorite;
use Modules\Appointment\Entities\Appointment;
use DB;
use GeneralTrait;
use Modules\Auth\Traits\UserTrait;

trait UserMethods{
    use UserTrait;
    use GeneralTrait{
        GeneralTrait::getPaginatesData as getPaginatesDataMethod;
        GeneralTrait::paginatesData as paginatesDataMethod;
        GeneralTrait::action as actionMethod;
    }

    /**
    * Method for get Relations  User.
    *
    * @return object
    */
    public function getRelationsUser($model,$request,$userId,$relation){
        $user=$this->find($userId,$model);
        if(is_string($user)){
            return $user;
        }
        if($relation=='roles'){
            return $user->roles()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        }elseif($relation=='permissions'){
            return $user->permissions()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        }

       }


    /**
    * Methods for get Data  Doctors.
    *
    * @return array
    */
    //get data//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        //get doctors from users table
        $allDoctors  = $this->usersRoleRetrive('doctor');
        if($lang && $result) return $allDoctors->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->paginate($request->total);
        else return $allDoctors->withoutGlobalScope(ActiveScope::class)->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        $allDoctors  = $this->usersRoleRetrive('doctor');
        if($lang && $result) return $allDoctors->where(['main_lang'=>$lang])->where('active','1')->get();
        else return $allDoctors->where('active','1')->get();
    }

    //methods filters//
    //pagination data filter
    public function getPaginateDataFilter(){
        if(fav()) return paginate($this->filterDoctorsWithFav());
        else return paginate($this->filterDoctors());
    }
    //get all data filter
    public function getAllDataFilter(){
        if(fav()) return $this->filterDoctorsWithFav();
        else return $this->filterDoctors();
    }

    public function filterDoctorRate($rate,$doctors){
        $arrFilterReview = array();
        foreach($doctors as $doctor){
            $avg = avgRatingReview($doctor->id);
            if($avg == $rate){
                if($doctor->profile) array_push($arrFilterReview,$doctor);
            }
        }
        return $arrFilterReview;
    }
    public function filterDoctorDay($day,$doctors){
        $arrFilterDay = array();
        foreach($doctors as $doctor){
            $dayDoctor =  Appointment::where(['doctor_id'=>$doctor->id,'day_id'=>$day])->first();
            if($dayDoctor){
                if($doctor->profile) array_push($arrFilterDay,$doctor);
            }

        }
        return $arrFilterDay;
    }

    public function filterDoctorsWithFav(){
        $doctors = User::where('full_name', 'like', '%'.search().'%')
                    ->whereHas('profile')
                    ->whereHas('roles', function($query) {
                    return    $query->where('name', 'doctor');
                    })
                    ->whereHas('specialties', function($query) {
                        return    $query->where('name', 'like', '%'.specialty().'%');
                    })
                    ->whereHas('favoritesDoctor', function($query) {
                        return    $query->where(['user_id'=> authUser()->id]);
                    })
                    ->where('active','1')
                    ->orderBy('created_at', 'desc')
                    ->get();
        if(rate()){
            if(count($doctors)!==0) return $this->filterDoctorDay(rate(),$doctors);
            else return $this->filterDoctorDay(rate(),$this->usersRole('doctor'));
        }
        if(day()){
            if(count($doctors)!==0) return $this->filterDoctorDay(day(),$doctors);
            else return $this->filterDoctorDay(day(),$this->usersRole('doctor'));
        }
        return $doctors;
    }

    public function filterDoctors(){
        if(specialty()){
            $doctors = User::where('full_name', 'like', '%'.search().'%')
                    ->whereHas('profile')
                    ->whereHas('roles', function($query) {
                        return   $query->where('name', 'doctor');
                    })
                    ->whereHas('specialties', function($query) {
                        return    $query->where('name', 'like', '%'.specialty().'%');
                    })
                    ->where('active','1')
                    ->orderBy('created_at', 'desc')
                    ->get();
            if(rate()){
                if(count($doctors)!==0)  return $this->filterDoctorRate(rate(),$doctors);
                else return $this->filterDoctorRate(rate(),$this->usersRole('doctor'));
            }
            if(day()){
                if(count($doctors)!==0) return $this->filterDoctorDay(day(),$doctors);
                else return $this->filterDoctorDay(day(),$this->usersRole('doctor'));
            }
        }else{
            $doctors = User::where('full_name', 'like', '%'.search().'%')
                    ->whereHas('profile')
                    ->whereHas('roles', function($query) {
                        return    $query->where('name', 'doctor');
                    })
                    // ->whereHas('specialties', function($query) {
                    //     $query->where('name', 'like', '%'.specialty().'%');
                    // })
                    ->where('active','1')
                    ->orderBy('created_at', 'desc')
                    ->get();
            if(rate()){
                if(count($doctors)!==0)  return $this->filterDoctorRate(rate(),$doctors);
                else return $this->filterDoctorRate(rate(),$this->usersRole('doctor'));
            }
            if(day()){
                if(count($doctors)!==0) return $this->filterDoctorDay(day(),$doctors);
                else return $this->filterDoctorDay(day(),$this->usersRole('doctor'));
            }
        }

        return $doctors;
    }
    public function topDoctors($model){//model:review
        $ratingDoctors = DB::table('calc_rate')->pluck('id');
        $doctors = User::whereIn('id',$ratingDoctors)->where('active','1')->get();
        if(page()) return paginate($doctors);
        else return $doctors;

    }

}
