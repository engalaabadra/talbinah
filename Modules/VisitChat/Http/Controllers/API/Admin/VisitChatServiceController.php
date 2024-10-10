<?php
namespace Modules\VisitChat\Http\Controllers\API\Admin;
use Modules\VisitChat\Http\Controllers\API\Admin\VisitChatController;
use Modules\VisitChat\Services\Admin\VisitChatService;
class VisitChatServiceController extends VisitChatController
{
    /**
     * @var VisitChatService
     */
    protected $visitService;
      
    
    /**
     * VisitChatServiceController constructor.
     *
     */
    public function __construct(VisitChatService $visitService)
    {
        $this->visitService = $visitService;
    }

    //to calling method service for VisitChat : 1. using object from it 2. register in app service container and using it
    
 }