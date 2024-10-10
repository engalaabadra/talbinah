<?php

namespace Modules\Reservation\Http\Controllers\API\ReasonRescheduling\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Repositories\ReasonRescheduling\Doctor\Resources\ReasonReschedulingRepository;
use Modules\Reservation\Entities\ReasonRescheduling;
use GeneralTrait;
use Modules\Reservation\Resources\Doctor\ReasonReschedulingResource;
class ReasonReschedulingResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReasonReschedulingRepository
     */
    protected $reasonReschedulingRepo;
        /**
     * @var ReasonRescheduling
     */
    protected $reasonRescheduling;
    
    /**
     * ReasonReschedulingResourceController constructor.
     *
     * @param ReasonReschedulingRepository $reasonReschedulings
     */
    public function __construct( ReasonRescheduling $reasonRescheduling,ReasonReschedulingRepository $reasonReschedulingRepo)
    {
        $this->reasonRescheduling = $reasonRescheduling;
        $this->reasonReschedulingRepo = $reasonReschedulingRepo;
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $reasonReschedulings = $this->reasonReschedulingRepo->all($request,$this->reasonRescheduling);
        if(page()) $data=getDataResponse(ReasonReschedulingResource::collection($reasonReschedulings));
        else $data=ReasonReschedulingResource::collection($reasonReschedulings);
        return successResponse(0,$data);
    }
   
}
