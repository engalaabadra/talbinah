<?php

namespace Modules\VisitChat\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\VisitChat\Entities\VisitChat;
use GeneralTrait;
use Modules\VisitChat\Services\Doctor\VisitChatService;
class VisitChatServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitChatService
     */
    protected $visitService;
        /**
     * @var VisitChat
     */
    protected $visit;
    
    /**
     * VisitChatServiceController constructor.
     *
     * @param VisitChatService $visits
     */
    public function __construct( VisitChat $visit,VisitChatService $visitService)
    {
        $this->visit = $visit;
        $this->visitService = $visitService;
    }

}
