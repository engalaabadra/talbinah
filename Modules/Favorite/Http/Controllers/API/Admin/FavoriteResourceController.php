<?php

namespace Modules\Favorite\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Favorite\Http\Requests\StoreFavoriteRequest;
use Modules\Favorite\Http\Requests\UpdateFavoriteRequest;
use Modules\Favorite\Http\Requests\DeleteFavoriteRequest;
use App\Repositories\EloquentRepository;
use Modules\Favorite\Repositories\Admin\Resources\FavoriteRepository;
use Modules\Favorite\Entities\Favorite;
use GeneralTrait;
use Modules\Favorite\Resources\Admin\FavoriteResource;

class FavoriteResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepo;
        /**
     * @var Favorite
     */
    protected $favorite;
    
    /**
     * FavoritesController constructor.
     *
     * @param FavoriteRepository $favorites
     */
    public function __construct(EloquentRepository $eloquentRepo, Favorite $favorite,FavoriteRepository $favoriteRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->favorite = $favorite;
        $this->favoriteRepo = $favoriteRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $favorites=$this->favoriteRepo->all($this->favorite,$lang);
        $data=FavoriteResource::collection($favorites);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $favorites=$this->favoriteRepo->getAllPaginates($this->favorite,$request,$lang);
        $data=getDataResponse(FavoriteResource::collection($favorites));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $favorites=$this->favoriteRepo->search($this->favorite,$words,$col);
        $data=getDataResponse(FavoriteResource::collection($favorites));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $favorites=$this->favoriteRepo->trash($this->favorite,$request);
        if(is_string($favorites)) return  clientError(4,$favorites);
        $data=getDataResponse(FavoriteResource::collection($favorites));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavoriteRequest $request)
    {
        $favorite=  $this->favoriteRepo->store($request,$this->favorite);
        if(is_string($favorite)) return  clientError(0,$favorite);
        return successResponse(1,new FavoriteResource($favorite));
    }
    public function storeTrans(StoreFavoriteRequest $request,$id,$lang)
    {
        $favorite=  $this->favoriteRepo->storeTrans($request,$this->favorite,$id,$lang);
        return successResponse(1,new FavoriteResource($favorite));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorite=$this->favoriteRepo->show($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4,$favorite);
        return successResponse(0,new FavoriteResource($favorite));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavoriteRequest $request,$id)
    {
        $favorite= $this->favoriteRepo->update($request,$this->favorite,$id);
        if(is_numeric($favorite)) return  clientError(4,$favorite);
        return successResponse(2,new FavoriteResource($favorite));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $favorite =  $this->favoriteRepo->restore($id,$this->favorite);
        if(is_string($favorite)) return  clientError(4,$favorite);
        return successResponse(5,new FavoriteResource($favorite));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $favorites =  $this->favoriteRepo->restoreAll($this->favorite);
        if(is_string($favorite)) return  clientError(4,$favorite);
        return customResponse(205,$favorites );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteFavoriteRequest $request,$id)
    {
        $favorite= $this->favoriteRepo->destroy($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4,$favorite);
        return successResponse(2,new FavoriteResource($favorite));  
    }
    public function forceDelete(DeleteFavoriteRequest $request,$id)
    {
        //to make force destroy for a Favorite must be this Favorite  not found in Favorites table  , must be found in trash Categories
        $favorite=$this->favoriteRepo->forceDelete($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4,$favorite);
        return successResponse(4,new FavoriteResource($favorite));
    }

}
