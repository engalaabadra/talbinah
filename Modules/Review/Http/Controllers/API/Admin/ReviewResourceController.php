<?php

namespace Modules\Review\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Review\Http\Requests\StoreReviewRequest;
use Modules\Review\Http\Requests\UpdateReviewRequest;
use Modules\Review\Http\Requests\DeleteReviewRequest;
use App\Repositories\EloquentRepository;
use Modules\Review\Repositories\Admin\Resources\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\Admin\ReviewResource;

class ReviewResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ReviewRepository
     */
    protected $reviewRepo;
        /**
     * @var Review
     */
    protected $review;
    
    /**
     * ReviewsController constructor.
     *
     * @param ReviewRepository $reviews
     */
    public function __construct(EloquentRepository $eloquentRepo, Review $review,ReviewRepository $reviewRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $reviews=$this->reviewRepo->all($this->review,$lang);
        $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $reviews=$this->reviewRepo->getAllPaginates($this->review,$request,$lang);
        $data=getDataResponse(ReviewResource::collection($reviews));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $reviews=$this->reviewRepo->search($this->review,$words,$col);
        $data=getDataResponse(ReviewResource::collection($reviews));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $reviews=$this->reviewRepo->trash($this->review,$request);
        if(is_string($reviews)) return  clientError(4,$reviews);
        $data=getDataResponse(ReviewResource::collection($reviews));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $review=  $this->reviewRepo->store($request,$this->review);
        if(is_string($review)) return  clientError(0,$review);
        return successResponse(1,new ReviewResource($review));
    }
    public function storeTrans(StoreReviewRequest $request,$id,$lang)
    {
        $review=  $this->reviewRepo->storeTrans($request,$this->review,$id,$lang);
        return successResponse(1,new ReviewResource($review));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review=$this->reviewRepo->show($id,$this->review);
        if(is_numeric($review)) return  clientError(4,$review);
        return successResponse(0,new ReviewResource($review));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request,$id)
    {
        $review= $this->reviewRepo->update($request,$this->review,$id);
        if(is_numeric($review)) return  clientError(4,$review);
        return successResponse(2,new ReviewResource($review));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $review =  $this->reviewRepo->restore($id,$this->review);
        if(is_string($review)) return  clientError(4,$review);
        return successResponse(5,new ReviewResource($review));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $reviews =  $this->reviewRepo->restoreAll($this->review);
        if(is_string($review)) return  clientError(4,$review);
        return customResponse(205,$reviews );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteReviewRequest $request,$id)
    {
        $review= $this->reviewRepo->destroy($id,$this->review);
        if(is_numeric($review)) return  clientError(4,$review);
        return successResponse(2,new ReviewResource($review));  
    }
    public function forceDelete(DeleteReviewRequest $request,$id)
    {
        //to make force destroy for a Review must be this Review  not found in Reviews table  , must be found in trash Categories
        $review=$this->reviewRepo->forceDelete($id,$this->review);
        if(is_numeric($review)) return  clientError(4,$review);
        return successResponse(4,new ReviewResource($review));
    }

}
