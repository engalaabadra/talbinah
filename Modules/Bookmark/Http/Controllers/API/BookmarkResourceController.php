<?php

namespace Modules\Bookmark\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Modules\Bookmark\Repositories\Resources\BookmarkRepository;
use Modules\Bookmark\Entities\Bookmark;
use GeneralTrait;
use Illuminate\Http\Request;
use Modules\Bookmark\Resources\BookmarkResource;
use Modules\Bookmark\Http\Requests\AddToBookmarkRequest;
use Modules\Bookmark\Http\Requests\DeleteBookmarkRequest;
class BookmarkResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var BookmarkRepository
     */
    protected $bookmarkRepo;
        /**
     * @var Bookmark
     */
    protected $bookmark;
    
    /**
     * BookmarkResourceController constructor.
     *
     * @param BookmarkRepository $bookmarks
     */
    public function __construct( Bookmark $bookmark,BookmarkRepository $bookmarkRepo)
    {
        $this->bookmark = $bookmark;
        $this->bookmarkRepo = $bookmarkRepo;
    }

    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $bookmarks = $this->bookmarkRepo->all($request,$this->bookmark);
        if(page()) $data=getDataResponse(BookmarkResource::collection($bookmarks));
        else $data=BookmarkResource::collection($bookmarks);
        return successResponse(0,$data);
    }
    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddToBookmarkRequest $request){
        $bookmark=$this->bookmarkRepo->store($request,$this->bookmark);
        if(is_numeric($bookmark)) return clientError(4);
        if(is_string($bookmark)) return clientError(0,$bookmark);
        return successResponse(1,new BookmarkResource($bookmark->load(['user','article'])));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBookmarkRequest $request)
    {
        $bookmark= $this->bookmarkRepo->delete($this->bookmark,$request);
        if(is_numeric($bookmark)) return  clientError(4);
        if(is_string($bookmark)) return  clientError(0,$bookmark);
        return successResponse(2,$bookmark);
    }
}
