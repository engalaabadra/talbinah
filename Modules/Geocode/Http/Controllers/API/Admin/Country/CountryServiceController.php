<?php
namespace Modules\Geocode\Http\Controllers\API\Admin\Country;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Controllers\API\Admin\Country\CountryResourceController;
use Modules\Geocode\Services\Admin\Country\CountryService;
class CountryServiceController extends CountryResourceController
{
    /**
     * @var CountryService
     */
    protected $countryService;
      
    
    /**
     * CountryServiceController constructor.
     *
     */
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }
    
}