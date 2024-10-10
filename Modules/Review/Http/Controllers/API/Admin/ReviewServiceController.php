<?php
namespace Modules\Review\Http\Controllers\API\Admin;
use Modules\Review\Http\Controllers\API\Admin\ReviewController;
use Modules\Review\Services\Admin\ReviewService;
class ReviewServiceController extends ReviewController
{
    /**
     * @var ReviewService
     */
    protected $reviewService;
      
    
    /**
     * ReviewServiceController constructor.
     *
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    //to calling method service for Review : 1. using object from it 2. register in app service container and using it
    
 }