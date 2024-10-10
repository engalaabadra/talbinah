<?php

namespace Modules\VisitChat\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VisitChat\Repositories\User\Resources\VisitChatRepository;
use Modules\VisitChat\Entities\VisitChat;
use GeneralTrait;
use Modules\VisitChat\Resources\User\VisitChatResource;
use Modules\VisitChat\Http\Requests\AddToVisitChatRequest;
class VisitChatResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitChatRepository
     */
    protected $visitRepo;
        /**
     * @var VisitChat
     */
    protected $visit;
    
    /**
     * VisitChatResourceController constructor.
     *
     * @param VisitChatRepository $visits
     */
    public function __construct( VisitChat $visit,VisitChatRepository $visitRepo)
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
        if(page()) $data = getDataResponse(VisitChatResource::collection($visits));
        else $data = VisitChatResource::collection($visits);
        return successResponse(0,$data);
    }

    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddToVisitChatRequest $request){
        $visit=$this->visitRepo->store($request,$this->visit);
        if(is_numeric($visit)) return clientError(4);
        if(is_string($visit)) return clientError(0,$visit);
        return successResponse(1,new VisitChatResource($visit->load(['user','doctor'])));
    }
}
