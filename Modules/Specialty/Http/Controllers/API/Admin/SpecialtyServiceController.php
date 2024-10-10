<?php
namespace Modules\Specialty\Http\Controllers\API\Admin;
use Modules\Specialty\Http\Controllers\API\Admin\SpecialtyController;
use Modules\Specialty\Services\Admin\SpecialtyService;
class SpecialtyServiceController extends SpecialtyController
{
    /**
     * @var SpecialtyService
     */
    protected $specialtyService;
      
    
    /**
     * SpecialtyServiceController constructor.
     *
     */
    public function __construct(SpecialtyService $SpecialtyService)
    {
        $this->specialtyService = $SpecialtyService;
    }

    //to calling method service for Specialty : 1. using object from it 2. register in app service container and using it
    
 }