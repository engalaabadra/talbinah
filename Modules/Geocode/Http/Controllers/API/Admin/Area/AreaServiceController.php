<?php
namespace Modules\Geocode\Http\Controllers\API\Admin\Area;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Controllers\API\AreaResourceController;
use Modules\Geocode\Services\Area\AreaService;
class AreaServiceController extends AreaResourceController
{
    /**
     * @var AreaService
     */
    protected $areaService;
      
    
    /**
     * AreaServiceController constructor.
     *
     */
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }
    
}
