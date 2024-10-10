<?php

namespace Modules\Duration\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Duration\Repositories\DurationRepository;
use Modules\Duration\Entities\Duration;
use GeneralTrait;
use Modules\Duration\Resources\DurationResource;
class DurationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var DurationRepository
     */
    protected $durationRepo;
        /**
     * @var Duration
     */
    protected $duration;
    
    /**
     * DurationResourceController constructor.
     *
     * @param DurationRepository $durations
     */
    public function __construct( Duration $duration,DurationRepository $durationRepo)
    {
        $this->duration = $duration;
        $this->durationRepo = $durationRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $durations=$this->durationRepo->all($request,$this->duration);
        $data=DurationResource::collection($durations);
        return customResponse(200,$data);
    }
}
