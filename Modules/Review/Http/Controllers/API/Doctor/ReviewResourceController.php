<?php

namespace Modules\Review\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Review\Repositories\Doctor\Resources\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\Doctor\ReviewResource;
class ReviewResourceController extends Controller
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
     * ReviewResourceController constructor.
     *
     * @param ReviewRepository $reviews
     */
    public function __construct( Review $review,ReviewRepository $reviewRepo)
    {
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }
    public function getAllPaginates(Request $request,$lang=null){
        $reviews=$this->reviewRepo->getAllPaginates($this->review,$request,$lang);
        $data=getDataResponse(ReviewResource::collection($reviews));
        return successResponse(0,$data);
    }

}
