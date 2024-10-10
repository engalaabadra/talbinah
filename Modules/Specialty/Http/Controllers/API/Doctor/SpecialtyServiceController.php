<?php

namespace Modules\Specialty\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Services\Doctor\SpecialtyService;
class SpecialtyServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var SpecialtyService
     */
    protected $specialtyService;
        /**
     * @var Specialty
     */
    protected $specialty;
    
    /**
     * SpecialtyServiceController constructor.
     *
     * @param SpecialtyService $specialties
     */
    public function __construct( Specialty $specialty,SpecialtyService $specialtyService)
    {
        $this->specialty = $specialty;
        $this->specialtyService = $specialtyService;
    }

}
