<?php

namespace Modules\Specialty\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Specialty\Repositories\Doctor\Additional\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Resources\Doctor\SpecialtyResource;
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

}
