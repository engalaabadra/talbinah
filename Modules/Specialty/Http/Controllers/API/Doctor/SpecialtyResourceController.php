<?php

namespace Modules\Specialty\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Auth\Entities\User;
use Modules\Specialty\Repositories\Doctor\Resources\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use Illuminate\Http\Request;
use GeneralTrait;
use Modules\Specialty\Resources\Doctor\SpecialtyResource;
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
}
