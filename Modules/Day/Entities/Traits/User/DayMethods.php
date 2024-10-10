<?php
namespace Modules\Day\Entities\Traits\User;
trait DayMethods{
    public function getDaysDoctorMethod($model1,$model2,$doctorId){//model:user,model2:day
        $doctor = $this->find($model1,$doctorId,'id');
        if(is_numeric($doctor)) return 404;
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to show his durations');
        $appointmentsDoctor = $doctor->appointments()->with('day')->get();
        // dd($daysDoctor);
        $daysDoctor = array();
        foreach($appointmentsDoctor as $appointmentDoctor){
            $day = $this->find($model2,$appointmentDoctor->day_id,'id');
            if(is_numeric($day)) return 404;
            if(!in_array($day,$daysDoctor)) array_push($daysDoctor,$day);
        }
        return $daysDoctor;
    }
}
