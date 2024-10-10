<?php
namespace Modules\Geocode\Http\Controllers\API\Admin\City;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Controllers\API\CityResourceController;
use Modules\Geocode\Services\City\CityService;
class CityServiceController extends CityResourceController
{
    /**
     * @var CityService
     */
    protected $cityService;
      
    
    /**
     * CityServiceController constructor.
     *
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    
}
