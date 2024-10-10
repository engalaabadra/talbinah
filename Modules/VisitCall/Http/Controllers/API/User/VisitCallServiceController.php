<?php

namespace Modules\VisitCall\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Modules\VisitCall\Entities\VisitCall;
use GeneralTrait;
use Modules\VisitCall\Services\User\VisitCallService;
class VisitCallServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitCallService
     */
    protected $visitService;
        /**
     * @var VisitCall
     */
    protected $visit;
    
    /**
     * VisitCallServiceController constructor.
     *
     * @param VisitCallService $visits
     */
    public function __construct( VisitCall $visit,VisitCallService $visitService)
    {
        $this->visit = $visit;
        $this->visitService = $visitService;
    }

}
