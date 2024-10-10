<?php

namespace Modules\Review\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Review\Repositories\Doctor\Additional\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\Doctor\ReviewResource;
class ReviewController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReviewRepository
     */
    protected $reviewRepo;
        /**
     * @var Review
     */
    protected $review;
    
    /**
     * ReviewController constructor.
     *
     * @param ReviewRepository $reviews
     */
    public function __construct( Review $review,ReviewRepository $reviewRepo)
    {
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }

}
