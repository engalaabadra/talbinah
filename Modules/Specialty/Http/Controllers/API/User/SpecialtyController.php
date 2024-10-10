<?php

namespace Modules\Specialty\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Specialty\Repositories\User\Additional\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Resources\User\SpecialtyResource;
class SpecialtyController extends Controller
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
     * SpecialtyController constructor.
     *
     * @param SpecialtyRepository $specialties
     */
    public function __construct( Specialty $specialty,SpecialtyRepository $specialtyRepo)
    {
        $this->specialty = $specialty;
        $this->specialtyRepo = $specialtyRepo;
    }
    /**
     * Display a top listing  of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopSpecialties(Request $request){
        $specialties=$this->specialtyRepo->getTopSpecialties($request, $this->specialty);
        if(page()) $data = getDataResponse(SpecialtyResource::collection($specialties));
        else $data = SpecialtyResource::collection($specialties);
        return successResponse(0,$data);
    }
}
