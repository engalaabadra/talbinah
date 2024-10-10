<?php

namespace Modules\RequestWithdrawing\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RequestWithdrawing\Http\Requests\Admin\StoreRequestWithdrawingRequest;
use Modules\RequestWithdrawing\Http\Requests\Admin\UpdateRequestWithdrawingRequest;
use Modules\RequestWithdrawing\Http\Requests\Admin\DeleteRequestWithdrawingRequest;
use App\Repositories\EloquentRepository;
use Modules\RequestWithdrawing\Repositories\Admin\Resources\RequestWithdrawingRepository;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use GeneralTrait;
use Modules\RequestWithdrawing\Resources\Admin\RequestWithdrawingResource;

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
        $wallet=$this->requestWithdrawingRepo->all($request, $this->wallet);
        $data = WalletResource::collection($wallet);
        return successResponse(0,$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestWithdrawingRequest $request,$id)
    {
        $requestWithdrawing= $this->requestWithdrawingRepo->update($this->requestWithdrawing,$id);
        if(is_numeric($requestWithdrawing)) return  clientError(4,$requestWithdrawing);
        return successResponse(2,new RequestWithdrawingResource($requestWithdrawing));
    }
}
