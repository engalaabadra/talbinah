<?php

namespace Modules\Communication\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Communication\Repositories\Admin\Resources\CommunicationRepository;
use Modules\Communication\Entities\Communication;
use GeneralTrait;
use Modules\Communication\Resources\Admin\CommunicationResource;
use Modules\Communication\Http\Requests\StoreCommunicationRequest;
use Modules\Communication\Http\Requests\UpdateCommunicationRequest;
class CommunicationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var CommunicationRepository
     */
    protected $communicationRepo;
        /**
     * @var Communication
     */
    protected $communication;
    
    /**
     * CommunicationController constructor.
     *
     * @param CommunicationRepository $communications
     */
    public function __construct( Communication $communication,CommunicationRepository $communicationRepo)
    {
        $this->communication = $communication;
        $this->communicationRepo = $communicationRepo;
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunicationRequest $request)
    {
        $communication=  $this->communicationRepo->store($request,$this->communication);
        if(is_string($communication)) return  clientError(0,$communication);
        return successResponse(1,new CommunicationResource($communication));
    }
    public function storeTrans(StoreCommunicationRequest $request,$id,$lang)
    {
        $communication=  $this->BannerRepo->storeTrans($request,$this->communication,$id,$lang);
        return successResponse(1,new CommunicationResource($communication));
    }
 /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunicationRequest $request,$id)
    {
        $communication= $this->communicationRepo->update($request,$this->communication,$id);
        if(is_numeric($communication)) return  clientError(4,$communication);
        return successResponse(2,new CommunicationResource($communication));
    }


}
