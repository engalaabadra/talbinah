<?php

namespace Modules\Day\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Day\Repositories\Resources\DayRepository;
use Modules\Day\Entities\Day;
use GeneralTrait;
use Modules\Day\Resources\User\DayResource;
class DayResourceController extends Controller
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
     * DayResourceController constructor.
     *
     * @param DayRepository $days
     */
    public function __construct( Day $day,DayRepository $dayRepo)
    {
        $this->day = $day;
        $this->dayRepo = $dayRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $days=$this->dayRepo->all($request, $this->day);
        if(page()) $data = getDataResponse(DayResource::collection($days));
        else $data = DayResource::collection($days);
        return successResponse(0,$data);
    }

}
