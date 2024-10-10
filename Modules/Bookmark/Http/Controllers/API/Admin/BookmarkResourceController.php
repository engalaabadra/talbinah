<?php

namespace Modules\Bookmark\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bookmark\Http\Requests\StoreBookmarkRequest;
use Modules\Bookmark\Http\Requests\UpdateBookmarkRequest;
use Modules\Bookmark\Http\Requests\DeleteBookmarkRequest;
use App\Repositories\EloquentRepository;
use Modules\Bookmark\Repositories\Admin\Resources\BookmarkRepository;
use Modules\Bookmark\Entities\Bookmark;
use GeneralTrait;
use Modules\Bookmark\Resources\Admin\BookmarkResource;

class BookmarkResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BookmarkRepository
     */
    protected $bookmarkRepo;
        /**
     * @var Bookmark
     */
    protected $bookmark;
    
    /**
     * BookmarksController constructor.
     *
     * @param BookmarkRepository $bookmarks
     */
    public function __construct(EloquentRepository $eloquentRepo, Bookmark $bookmark,BookmarkRepository $bookmarkRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->bookmark = $bookmark;
        $this->bookmarkRepo = $bookmarkRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $bookmarks=$this->bookmarkRepo->all($this->bookmark,$lang);
        $data=BookmarkResource::collection($bookmarks);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $bookmarks=$this->bookmarkRepo->getAllPaginates($this->bookmark,$request,$lang);
        $data=getDataResponse(BookmarkResource::collection($bookmarks));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $bookmarks=$this->bookmarkRepo->search($this->bookmark,$words,$col);
        $data=getDataResponse(BookmarkResource::collection($bookmarks));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $bookmarks=$this->bookmarkRepo->trash($this->bookmark,$request);
        if(is_string($bookmarks)) return  clientError(4,$bookmarks);
        $data=getDataResponse(BookmarkResource::collection($bookmarks));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookmarkRequest $request)
    {
        $bookmark=  $this->bookmarkRepo->store($request,$this->bookmark);
        if(is_string($bookmark)) return  clientError(0,$bookmark);
        return successResponse(1,new BookmarkResource($bookmark));
    }
    public function storeTrans(StoreBookmarkRequest $request,$id,$lang)
    {
        $bookmark=  $this->bookmarkRepo->storeTrans($request,$this->bookmark,$id,$lang);
        return successResponse(1,new BookmarkResource($bookmark));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookmark=$this->bookmarkRepo->show($id,$this->bookmark);
        if(is_numeric($bookmark)) return  clientError(4,$bookmark);
        return successResponse(0,new BookmarkResource($bookmark));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookmarkRequest $request,$id)
    {
        $bookmark= $this->bookmarkRepo->update($request,$this->bookmark,$id);
        if(is_numeric($bookmark)) return  clientError(4,$bookmark);
        return successResponse(2,new BookmarkResource($bookmark));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $bookmark =  $this->bookmarkRepo->restore($id,$this->bookmark);
        if(is_string($bookmark)) return  clientError(4,$bookmark);
        return successResponse(5,new BookmarkResource($bookmark));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $bookmarks =  $this->bookmarkRepo->restoreAll($this->bookmark);
        if(is_string($bookmark)) return  clientError(4,$bookmark);
        return customResponse(205,$bookmarks );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBookmarkRequest $request,$id)
    {
        $bookmark= $this->bookmarkRepo->destroy($id,$this->bookmark);
        if(is_numeric($bookmark)) return  clientError(4,$bookmark);
        return successResponse(2,new BookmarkResource($bookmark));  
    }
    public function forceDelete(DeleteBookmarkRequest $request,$id)
    {
        //to make force destroy for a Bookmark must be this Bookmark  not found in Bookmarks table  , must be found in trash Categories
        $bookmark=$this->bookmarkRepo->forceDelete($id,$this->bookmark);
        if(is_numeric($bookmark)) return  clientError(4,$bookmark);
        return successResponse(4,new BookmarkResource($bookmark));
    }

}
