<?php

namespace Modules\Communication\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Communication\Repositories\CommunicationRepository;
use Modules\Communication\Entities\Communication;
use GeneralTrait;
use Modules\Communication\Resources\CommunicationResource;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $communications=$this->communicationRepo->all($request, $this->communication);
        if(page()) $data=getDataResponse(CommunicationResource::collection($communications));
        else $data=CommunicationResource::collection($communications);
        return customResponse(200,$data);
    }


}
