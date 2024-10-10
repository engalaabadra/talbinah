<?php
namespace Modules\RequestWithdrawing\Http\Controllers\API\Admin;
use Modules\RequestWithdrawing\Http\Controllers\API\Admin\RequestWithdrawingController;
use Modules\RequestWithdrawing\Services\Admin\RequestWithdrawingService;
class RequestWithdrawingServiceController extends RequestWithdrawingController
{
    /**
     * @var RequestWithdrawingService
     */
    protected $requestWithdrawingService;
      
    
    /**
     * RequestWithdrawingServiceController constructor.
     *
     */
    public function __construct(RequestWithdrawingService $requestWithdrawingService)
    {
        $this->requestWithdrawingService = $requestWithdrawingService;
    }

    //to calling method service for RequestWithdrawing : 1. using object from it 2. register in app service container and using it
    
 }