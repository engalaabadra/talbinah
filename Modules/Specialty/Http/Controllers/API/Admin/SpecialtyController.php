<?php

namespace Modules\Specialty\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Specialty\Repositories\Admin\Additional\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Http\Controllers\API\Admin\SpecialtyResourceController;
class SpecialtyController extends SpecialtyResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var SpecialtyRepository
     */
    protected $specialtyRepo;
        /**
     * @var Specialty
     */
    protected $specialty;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Specialty $specialty
     * @param SpecialtyRepository $specialtyRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Specialty $specialty,SpecialtyRepository $specialtyRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->specialty = $specialty;
        $this->specialtyRepo = $specialtyRepo;
    }

}
