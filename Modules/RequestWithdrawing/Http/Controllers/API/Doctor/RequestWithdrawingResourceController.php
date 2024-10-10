<?php

namespace Modules\RequestWithdrawing\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\EloquentRepository;
use Modules\RequestWithdrawing\Repositories\Doctor\Resources\RequestWithdrawingRepository;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use GeneralTrait;
use Modules\RequestWithdrawing\Resources\Doctor\RequestWithdrawingResource;

class RequestWithdrawingResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var RequestWithdrawingRepository
     */
    protected $requestWithdrawingRepo;
        /**
     * @var RequestWithdrawing
     */
    protected $requestWithdrawing;
    
    /**
     * RequestWithdrawingsController constructor.
     *
     * @param RequestWithdrawingRepository $requestWithdrawings
     */
    public function __construct(EloquentRepository $eloquentRepo, RequestWithdrawing $requestWithdrawing,RequestWithdrawingRepository $requestWithdrawingRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->requestWithdrawing = $requestWithdrawing;
        $this->requestWithdrawingRepo = $requestWithdrawingRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $requestWithdrawing=$this->requestWithdrawingRepo->all($request, $this->requestWithdrawing);
        $data = RequestWithdrawingResource::collection($requestWithdrawing);
        return successResponse(0,$data);
    }
    
}
