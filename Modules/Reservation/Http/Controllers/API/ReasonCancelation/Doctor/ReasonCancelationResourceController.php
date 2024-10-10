<?php

namespace Modules\Reservation\Http\Controllers\API\ReasonCancelation\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Repositories\ReasonCancelation\Doctor\Resources\ReasonCancelationRepository;
use Modules\Reservation\Entities\ReasonCancelation;
use GeneralTrait;
use Modules\Reservation\Resources\Doctor\ReasonCancelationResource;
class ReasonCancelationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReasonCancelationRepository
     */
    protected $reasonCancelationRepo;
        /**
     * @var ReasonCancelation
     */
    protected $reasonCancelation;
    
    /**
     * ReasonCancelationResourceController constructor.
     *
     * @param ReasonCancelationRepository $reasonCancelations
     */
    public function __construct( ReasonCancelation $reasonCancelation,ReasonCancelationRepository $reasonCancelationRepo)
    {
        $this->reasonCancelation = $reasonCancelation;
        $this->reasonCancelationRepo = $reasonCancelationRepo;
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $reasonCancelations = $this->reasonCancelationRepo->all($request,$this->reasonCancelation);
        if(page()) $data=getDataResponse(ReasonCancelationResource::collection($reasonCancelations));
        else $data=ReasonCancelationResource::collection($reasonCancelations);
        return successResponse(0,$data);
    }
   
}
