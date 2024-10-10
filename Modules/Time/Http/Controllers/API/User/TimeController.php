<?php

namespace Modules\Time\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Time\Repositories\User\TimeRepository;
use Modules\Appointment\Entities\Appointment;
use Modules\Duration\Entities\Duration;
use Modules\Day\Entities\Day;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Time\Resources\User\TimeResource;
use Modules\Time\Http\Requests\User\GetTimeRequest;
use Illuminate\Support\Facades\Validator;

class TimeController extends Controller
{
    use GeneralTrait;
    /**
     * @var TimeRepository
     */
    protected $timeRepo;
    /**
     * @var Appointment
     */
    protected $appointment;
    /**
     * @var Duration
     */
    protected $duration;
    /**
     * @var Day
     */
    protected $day;
    /**
     * @var User
     */
    protected $user;
    
    /**
     * TimeController constructor.
     *
     * @param TimeRepository $times
     */
    public function __construct( Appointment $appointment,Day $day,Duration $duration,User $user,TimeRepository $timeRepo)
    {
        $this->day = $day;
        $this->duration = $duration;
        $this->appointment = $appointment;
        $this->user = $user;
        $this->timeRepo = $timeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allTimesDay(Request $request, $dayId,$durationId,$doctorId){
        $validator = Validator::make($request->all(), [
            'date' => ['required','date','date_format:Y-m-d','after:yesterday']
        ]);
        if ($validator->fails()) {
            // handle validation errors
            return clientError(0,trans('messages.date must be today or after today'));
        }
        $times=$this->timeRepo->getTimesDay($request,$this->appointment,$this->day,$this->duration,$this->user,$dayId,$durationId,$doctorId);
        if(is_numeric($times)) return clientError(4);
        if(is_string($times)) return clientError(0,$times);
        return successResponse(0,$times);
    }
}
