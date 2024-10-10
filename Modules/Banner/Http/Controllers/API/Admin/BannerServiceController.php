<?php
namespace Modules\Banner\Http\Controllers\API\Admin;
use Modules\Banner\Http\Controllers\API\Admin\BannerController;
use Modules\Banner\Services\Admin\BannerService;
class BannerServiceController extends BannerController
{
    /**
     * @var BannerService
     */
    protected $bannerService;
      
    
    /**
     * BannerServiceController constructor.
     *
     */
    public function __construct(BannerService $bannerService)
    {
        $this->BannerService = $bannerService;
    }

    //to calling method service for Banner : 1. using object from it 2. register in app service container and using it
    
 }