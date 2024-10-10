<?php

namespace Modules\VisitCall\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VisitCall\Repositories\User\Resources\VisitCallRepository;
use Modules\VisitCall\Entities\VisitCall;
use GeneralTrait;
use Modules\VisitCall\Resources\User\VisitCallResource;
use Modules\VisitCall\Http\Requests\AddToVisitCallRequest;
class VisitCallResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitCallRepository
     */
    protected $visitRepo;
        /**
     * @var VisitCall
     */
    protected $visit;
    
    /**
     * VisitCallResourceController constructor.
     *
     * @param VisitCallRepository $visits
     */
    public function __construct( VisitCall $visit,VisitCallRepository $visitRepo)
    {
        $this->visit = $visit;
        $this->visitRepo = $visitRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $visits=$this->visitRepo->all($request, $this->visit);
        if(page()) $data = getDataResponse(VisitCallResource::collection($visits));
        else $data = VisitCallResource::collection($visits);
        return successResponse(0,$data);
    }

    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddToVisitCallRequest $request){
        $visit=$this->visitRepo->store($request,$this->visit);
        if(is_numeric($visit)) return clientError(4);
        if(is_string($visit)) return clientError(0,$visit);
        return successResponse(1,new VisitCallResource($visit->load(['user','doctor'])));
    }
}
