<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\State;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\State\StoreStateRequest;
use Modules\Geocode\Http\Requests\State\UpdateStateRequest;
use Modules\Geocode\Http\Requests\State\DeleteStateRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\State\Resources\StateRepository;
use Modules\Geocode\Entities\State;
use GeneralTrait;
use Modules\Geocode\Resources\StateResource;
class StateResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var StateRepository
     */
    protected $stateRepo;
        /**
     * @var State
     */
    protected $state;
    
    /**
     * StateController constructor.
     *
     * @param StateRepository $states
     */
    public function __construct(EloquentRepository $eloquentRepo, State $state,StateRepository $stateRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->state = $state;
        $this->stateRepo = $stateRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $states=$this->stateRepo->all($this->state,$lang);
            $data=StateResource::collection($states);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        try{
            $states=$this->stateRepo->getAllPaginates($this->state,$request,$lang);
            $data=StateResource::collection($states)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }

    public function getStatesCity($cityId){
        try{
            $states=$this->stateRepo->getStatesCity($this->state,$cityId);
            if(is_string($states)){
                return customResponse(404,[],$states);
            }
            $data=StateResource::collection($states)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    
    public function cityState($stateId){
        try{
            $city=$this->stateRepo->countryCity($this->state,$stateId);
            if(is_string($city)){
                return customResponse(404,[],$city);
            }
            $data=StateResource::collection($city)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    // methods for trash
    public function trash(Request $request){
        try{
            $states=$this->stateRepo->trash($this->state,$request);
            if(is_string($states)){
                return customResponse(404,[],$states);
            }
            $data=StateResource::collection($states)->getDataResponse();
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
    public function store(StoreStateRequest $request)
    {
        try{
            $state=  $this->stateRepo->store($request,$this->state);
            if(is_string($state)){
                return customResponse(400,[],$state);
            }
            
            return customResponse(201, new StateResource($state));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreStateRequest $request,$id,$lang)
    {
        try{
        $state=  $this->stateRepo->storeTrans($request,$this->state,$id,$lang);

        return customResponse(201, new StateResource($state));
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
            $state=$this->stateRepo->show($id,$this->state);
            if(is_string($state)){
                return customResponse(404,[],$state);
            }
            return customResponse(200,new StateResource($state));
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
    public function update(UpdateStateRequest $request,$id)
    {
        try{
            $state= $this->stateRepo->update($request,$id,$this->state);
                
                if(is_string($state)){
                    return customResponse(404,[],$state);
                }
                return customResponse(202, new StateResource($state));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $state =  $this->stateRepo->restore($id,$this->state);
            
            if(is_string($state)){
                return customResponse(404,[],$state);
            }
            return customResponse(205, new StateResource($state));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $states =  $this->stateRepo->restoreAll($this->state);
            
            if(is_string($states)){
                return customResponse(404,[],$states);
            }
            return customResponse(205,$states );
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
    public function destroy(DeleteStateRequest $request,$id)
    {
        try{
            $state= $this->stateRepo->destroy($id,$this->state);
                if(is_string($state)){
                    return customResponse(404,[],$state);
                }
                return customResponse(202,new StateResource($state));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteStateRequest $request,$id)
    {
        try{
            //to make force destroy for a State must be this State  not found in State table  , must be found in trash Categories
            $state=$this->stateRepo->forceDelete($id,$this->state);
            if(is_string($state)){
                return customResponse(404,[],$state);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
