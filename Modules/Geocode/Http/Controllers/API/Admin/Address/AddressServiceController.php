<?php
namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Controllers\API\AddressResourceController;
use Modules\Geocode\Services\Address\AddressService;
class AddressServiceController extends AddressResourceController
{
    /**
     * @var AddressService
     */
    protected $addressService;
      
    
    /**
     * AddressServiceController constructor.
     *
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    
}
