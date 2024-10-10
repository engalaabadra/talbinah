<?php

namespace Modules\Specialty\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Specialty\Repositories\User\Resources\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Resources\User\SpecialtyResource;
class SpecialtyResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var SpecialtyRepository
     */
    protected $specialtyRepo;
        /**
     * @var Specialty
     */
    protected $specialty;


    
    /**
     * SpecialtyResourceController constructor.
     *
     * @param SpecialtyRepository $specialties
     */
    public function __construct( Specialty $specialty,SpecialtyRepository $specialtyRepo)
    {
        $this->specialty = $specialty;
        $this->specialtyRepo = $specialtyRepo;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $specialties=$this->specialtyRepo->all($request, $this->specialty);
        if(page()) $data = getDataResponse(SpecialtyResource::collection($specialties));
        else $data = SpecialtyResource::collection($specialties);
        return successResponse(0,$data);
    }

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words){
        $specialties=$this->specialtyRepo->search($this->specialty,$words,'name');
        $data= getDataResponse(SpecialtyResource::collection($specialties));
        return successResponse(0,$data);
    }

}
