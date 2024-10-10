<?php

namespace Modules\Day\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Day\Repositories\Doctor\Additional\DayRepository;
use Modules\Day\Entities\Day;
use GeneralTrait;
use Modules\Appointment\Resources\Doctor\AppointmentResource;
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
     * DayController constructor.
     *
     * @param DayRepository $days
     */
    public function __construct( Day $day,DayRepository $dayRepo)
    {
        $this->day = $day;
        $this->dayRepo = $dayRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppointmentsDay($dayId){
        $days=$this->dayRepo->appointmentsDay($dayId,$this->day);
        $data=AppointmentResource::collection($days);
        return customResponse(200,$data);
    }
}
