<?php

namespace Modules\Day\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Modules\Day\Repositories\User\Additional\DayRepository;
use Modules\Appointment\Entities\Appointment;
use Modules\Day\Entities\Day;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
use GeneralTrait;
use Modules\Day\Resources\User\DayResource;
class DayController extends Controller
{
    use GeneralTrait;
    /**
     * @var DayRepository
     */
    protected $dayRepo;
    /**
     * @var Day
     */
    protected $day;
    /**
     * @var Duration
     */
    protected $duration;
    /**
     * @var User
     */
    protected $user;
    /**
     * DayController constructor.
     *
     * @param DayRepository $days
     */
    public function __construct( Day $day,Duration $duration,User $user,DayRepository $dayRepo)
    {
        $this->day = $day;
        $this->user = $user;
        $this->duration = $duration;
        $this->dayRepo = $dayRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDaysDoctor($doctorId){
        $days=$this->dayRepo->getDaysDoctor($this->user,$this->day,$doctorId);
        if(is_numeric($days)) return clientError(4);
        $filterDays = [];
        foreach($days as $day){
            $appointments = Appointment::where(['active'=>1,'doctor_id'=>$doctorId,'day_id'=>$day->id])->get();
            if(count($appointments)>0){
                foreach($appointments as $apponitment){
                    if($apponitment->active){
                        array_push($filterDays,$day);
                    }
                    
                }
                
            }
        }
        if(is_numeric($filterDays)) return clientError(4);
        if(is_string($filterDays)) return clientError(0,$filterDays);
        $data=DayResource::collection($filterDays);
        return successResponse(0,$data);
    }
}
