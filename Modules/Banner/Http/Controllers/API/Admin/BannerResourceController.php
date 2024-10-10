<?php

namespace Modules\Banner\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Http\Requests\StoreBannerRequest;
use Modules\Banner\Http\Requests\UpdateBannerRequest;
use Modules\Banner\Http\Requests\DeleteBannerRequest;
use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\Admin\Resources\BannerRepository;
use Modules\Banner\Entities\Banner;
use GeneralTrait;
use Modules\Banner\Resources\Admin\BannerResource;

class BannerResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BannerRepository
     */
    protected $bannerRepo;
        /**
     * @var Banner
     */
    protected $banner;
    
    /**
     * BannersController constructor.
     *
     * @param BannerRepository $banners
     */
    public function __construct(EloquentRepository $eloquentRepo, Banner $banner,BannerRepository $bannerRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->Banner = $banner;
        $this->BannerRepo = $bannerRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $banners=$this->bannerRepo->all($request, $this->banner);
        $data=getDataResponse(BannerResource::collection($banners));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $banners=$this->BannerRepo->search($this->Banner,$words,$col);
        $data=getDataResponse(BannerResource::collection($banners));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $banners=$this->BannerRepo->trash($this->Banner,$request);
        if(is_string($banners)) return  clientError(4,$banners);
        $data=getDataResponse(BannerResource::collection($banners));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $banner=  $this->BannerRepo->store($request,$this->Banner);
        if(is_string($banner)) return  clientError(0,$banner);
        return successResponse(1,new BannerResource($banner));
    }
    public function storeTrans(StoreBannerRequest $request,$id,$lang)
    {
        $banner=  $this->BannerRepo->storeTrans($request,$this->Banner,$id,$lang);
        return successResponse(1,new BannerResource($banner));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner=$this->BannerRepo->show($id,$this->Banner);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(0,new BannerResource($banner));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request,$id)
    {
        $banner= $this->BannerRepo->update($request,$this->Banner,$id);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(2,new BannerResource($banner));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $banner =  $this->BannerRepo->restore($id,$this->Banner);
        if(is_string($banner)) return  clientError(4,$banner);
        return successResponse(5,new BannerResource($banner));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $banners =  $this->BannerRepo->restoreAll($this->Banner);
        if(is_string($banner)) return  clientError(4,$banner);
        return customResponse(205,$banners );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBannerRequest $request,$id)
    {
        $banner= $this->BannerRepo->destroy($id,$this->Banner);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(2,new BannerResource($banner));  
    }
    public function forceDelete(DeleteBannerRequest $request,$id)
    {
        //to make force destroy for a Banner must be this Banner  not found in Banners table  , must be found in trash Categories
        $banner=$this->BannerRepo->forceDelete($id,$this->Banner);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(4,new BannerResource($banner));
    }

}
