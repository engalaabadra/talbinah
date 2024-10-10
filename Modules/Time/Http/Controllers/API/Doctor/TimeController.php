<?php

namespace Modules\Time\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Time\Repositories\Doctor\TimeRepository;
use Modules\Time\Entities\Time;
use Modules\Appointment\Entities\Appointment;
use Modules\Duration\Entities\Duration;
use Modules\Day\Entities\Day;
use Modules\Auth\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GeneralTrait;
use Modules\Time\Resources\Doctor\TimeResource;
class TimeController extends Controller
{
    use GeneralTrait;
    /**
     * @var TimeRepository
     */
    protected $timeRepo;
        /**
     * @var Time
     */
    protected $time;
    
    /**
     * TimeController constructor.
     *
     * @param TimeRepository $times
     */
    public function __construct( Appointment $appointment,Day $day,Duration $duration,User $user, Time $time,TimeRepository $timeRepo)
    {
        $this->time = $time;
        $this->timeRepo = $timeRepo;
        $this->day = $day;
        $this->duration = $duration;
        $this->appointment = $appointment;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(){
        $times=$this->timeRepo->all($this->time);
        $data=TimeResource::collection($times);
        return customResponse(200,$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allTimesDay(Request $request, $dayId,$durationId){
        $validator = Validator::make($request->all(), [
            'date' => ['required','date','date_format:Y-m-d','after:yesterday']
        ]);
        if ($validator->fails()) {
            // handle validation errors
            return clientError(0,trans('messages.date must be today or after today'));
        }
        $times=$this->timeRepo->getTimesDay($request,$this->appointment,$this->day,$this->duration,$this->user,$dayId,$durationId);
        if(is_numeric($times)) return clientError(4);
        if(is_string($times)) return clientError(0,$times);
        return successResponse(0,$times);
    }
}
