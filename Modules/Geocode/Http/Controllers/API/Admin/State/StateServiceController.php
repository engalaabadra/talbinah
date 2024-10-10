<?php
namespace Modules\Geocode\Http\Controllers\API\Admin\State;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Controllers\API\StateResourceController;
use Modules\Geocode\Services\State\StateService;
class StateServiceController extends StateResourceController
{
    /**
     * @var StateService
     */
    protected $stateService;
      
    
    /**
     * StateServiceController constructor.
     *
     */
    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }
    
}
