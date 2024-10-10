<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Area;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Area\StoreAreaRequest;
use Modules\Geocode\Http\Requests\Area\UpdateAreaRequest;
use Modules\Geocode\Http\Requests\Area\DeleteAreaRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\Area\Resources\AreaRepository;
use Modules\Geocode\Entities\Area;
use GeneralTrait;
use Modules\Geocode\Resources\AreaResource;
class AreaResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AreaRepository
     */
    protected $areaRepo;
        /**
     * @var Area
     */
    protected $area;
    
    /**
     * AreaController constructor.
     *
     * @param AreaRepository $areas
     */
    public function __construct(EloquentRepository $eloquentRepo, Area $area,AreaRepository $areaRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->area = $area;
        $this->areaRepo = $areaRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $areas=$this->areaRepo->all($this->area,$lang);
            $data=AreaResource::collection($areas);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        try{
            $areas=$this->areaRepo->getAllPaginates($this->area,$request,$lang);
            $data=AreaResource::collection($areas)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAreasState($stateId){
        try{
            $areas=$this->areaRepo->getAreasState($this->area,$stateId);
            if(is_string($areas)){
                return customResponse(404,[],$areas);
            }
            dd($areas);
            $data=AreaResource::collection($areas)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    
    public function areaState($areaId){
        try{
            $state=$this->areaRepo->areaState($this->area,$areaId);
            if(is_string($state)){
                return customResponse(404,[],$state);
            }
            $data=AreaResource::collection($state)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }
    

    // methods for trash
    public function trash(Request $request){
        try{
            $areas=$this->areaRepo->trash($this->area,$request);
            if(is_string($areas)){
                return customResponse(404,[],$areas);
            }
            $data=AreaResource::collection($areas)->getDataResponse();
            return customResponse(200, $data);

        }catch(\Exception $ex){
            return customResponse(500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        try{
            $area=  $this->areaRepo->store($request,$this->area);
            if(is_string($area)){
                return customResponse(400,[],$area);
            }
            
            return customResponse(201, new AreaResource($area));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreAreaRequest $request,$id,$lang)
    {
        try{
        $area=  $this->areaRepo->storeTrans($request,$this->area,$id,$lang);

        return customResponse(201, new AreaResource($area));
    }catch(\Exception $ex){
            return customResponse(500);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $area=$this->areaRepo->show($id,$this->area);
            if(is_string($area)){
                return customResponse(404,[],$area);
            }
            return customResponse(200,new AreaResource($area));
        }catch(\Exception $ex){
            return customResponse(500);
        }

        
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request,$id)
    {
        try{
            $area= $this->areaRepo->update($request,$id,$this->area);
                
                if(is_string($area)){
                    return customResponse(404,[],$area);
                }
                return customResponse(202, new AreaResource($area));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $area =  $this->areaRepo->restore($id,$this->area);
            
            if(is_string($area)){
                return customResponse(404,[],$area);
            }
            return customResponse(205, new AreaResource($area));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $areas =  $this->areaRepo->restoreAll($this->area);
            
            if(is_string($areas)){
                return customResponse(404,[],$areas);
            }
            return customResponse(205,$areas );
        }catch(\Exception $ex){
            return customResponse(500);
        }
        

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAreaRequest $request,$id)
    {
        try{
            $area= $this->areaRepo->destroy($id,$this->area);
                if(is_string($area)){
                    return customResponse(404,[],$area);
                }
                return customResponse(202,new AreaResource($area));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteAreaRequest $request,$id)
    {
        try{
            //to make force destroy for a Area must be this Area  not found in Area table  , must be found in trash Categories
            $area=$this->areaRepo->forceDelete($id,$this->area);
            if(is_string($area)){
                return customResponse(404,[],$area);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
