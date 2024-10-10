<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\City;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\City\StoreCityRequest;
use Modules\Geocode\Http\Requests\City\UpdateCityRequest;
use Modules\Geocode\Http\Requests\City\DeleteCityRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\City\Resources\CityRepository;
use Modules\Geocode\Entities\City;
use GeneralTrait;
use Modules\Geocode\Resources\CityResource;
class CityResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var CityRepository
     */
    protected $cityRepo;
        /**
     * @var City
     */
    protected $city;
    
    /**
     * CitiesController constructor.
     *
     * @param CityRepository $cities
     */
    public function __construct(EloquentRepository $eloquentRepo, City $city,CityRepository $cityRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->city = $city;
        $this->cityRepo = $cityRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $cities=$this->cityRepo->all($this->city,$lang);
            $data=CityResource::collection($cities);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        try{
            $cities=$this->cityRepo->getAllPaginates($this->city,$request,$lang);
            $data=CityResource::collection($cities)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }

    public function getCitiesCountry($countryId){
        try{
            $cities=$this->cityRepo->getCitiesCountry($this->city,$countryId);
            if(is_string($cities)){
                return customResponse(404,[],$cities);
            }
            $data=CityResource::collection($cities)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    
    public function countryCity($cityId){
        try{
            $cities=$this->cityRepo->countryCity($this->city,$cityId);
            if(is_string($cities)){
                return customResponse(404,[],$cities);
            }
            $data=CityResource::collection($cities)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    // methods for trash
    public function trash(Request $request){
        try{
            $cities=$this->cityRepo->trash($this->city,$request);
            if(is_string($cities)){
                return customResponse(404,[],$cities);
            }
            $data=CityResource::collection($cities)->getDataResponse();
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
    public function store(StoreCityRequest $request)
    {
        try{
            $city=  $this->cityRepo->store($request,$this->city);
            if(is_string($city)){
                return customResponse(400,[],$city);
            }
            
            return customResponse(201, new CityResource($city));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreCityRequest $request,$id,$lang)
    {
        try{
        $city=  $this->cityRepo->storeTrans($request,$this->city,$id,$lang);

        return customResponse(201, new CityResource($city));
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
            $city=$this->cityRepo->show($id,$this->city);
            if(is_string($city)){
                return customResponse(404,[],$city);
            }
            return customResponse(200,new CityResource($city));
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
    public function update(UpdateCityRequest $request,$id)
    {
        try{
            $city= $this->cityRepo->update($request,$id,$this->city);
                
                if(is_string($city)){
                    return customResponse(404,[],$city);
                }
                return customResponse(202, new CityResource($city));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $city =  $this->cityRepo->restore($id,$this->city);
            
            if(is_string($city)){
                return customResponse(404,[],$city);
            }
            return customResponse(205, new CityResource($city));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $cities =  $this->cityRepo->restoreAll($this->city);
            
            if(is_string($cities)){
                return customResponse(404,[],$cities);
            }
            return customResponse(205,$cities );
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
    public function destroy(DeleteCityRequest $request,$id)
    {
        try{
            $city= $this->cityRepo->destroy($id,$this->city);
                if(is_string($city)){
                    return customResponse(404,[],$city);
                }
                return customResponse(202,new CityResource($city));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteCityRequest $request,$id)
    {
        try{
            //to make force destroy for a City must be this City  not found in Cities table  , must be found in trash Categories
            $city=$this->cityRepo->forceDelete($id,$this->city);
            if(is_string($city)){
                return customResponse(404,[],$city);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
