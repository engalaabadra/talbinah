<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Country;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Country\StoreCountryRequest;
use Modules\Geocode\Http\Requests\Country\UpdateCountryRequest;
use Modules\Geocode\Http\Requests\Country\DeleteCountryRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\Country\Resources\CountryRepository;
use Modules\Geocode\Entities\Country;
use GeneralTrait;
use Modules\Geocode\Resources\CountryResource;
class CountryResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var CountryRepository
     */
    protected $countryRepo;
        /**
     * @var Country
     */
    protected $country;
    
    /**
     * CountryController constructor.
     *
     * @param CountryRepository $countries
     */
    public function __construct(EloquentRepository $eloquentRepo, Country $country,CountryRepository $countryRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->country = $country;
        $this->countryRepo = $countryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $countries=$this->countryRepo->all($this->country,$lang);
            $data=CountryResource::collection($countries);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        try{
            $countries=$this->countryRepo->getAllPaginates($this->country,$request,$lang);
            $data=CountryResource::collection($countries)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }

    

    // methods for trash
    public function trash(Request $request){
        try{
            $countries=$this->countryRepo->trash($this->country,$request);
            if(is_string($countries)){
                return customResponse(404,[],$countries);
            }
            $data=CountryResource::collection($countries)->getDataResponse();
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
    public function store(StoreCountryRequest $request)
    {
        try{
            $country=  $this->countryRepo->store($request,$this->country);
            if(is_string($country)){
                return customResponse(400,[],$country);
            }
            
            return customResponse(201, new CountryResource($country));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreCountryRequest $request,$id,$lang)
    {
        try{
        $country=  $this->countryRepo->storeTrans($request,$this->country,$id,$lang);

        return customResponse(201, new CountryResource($country));
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
            $country=$this->countryRepo->show($id,$this->country);
            if(is_string($country)){
                return customResponse(404,[],$country);
            }
            return customResponse(200,new CountryResource($country));
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
    public function update(UpdateCountryRequest $request,$id)
    {
        try{
            $country= $this->countryRepo->update($request,$id,$this->country);
                
                if(is_string($country)){
                    return customResponse(404,[],$country);
                }
                return customResponse(202, new CountryResource($country));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $country =  $this->countryRepo->restore($id,$this->country);
            
            if(is_string($country)){
                return customResponse(404,[],$country);
            }
            return customResponse(205, new CountryResource($country));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $countries =  $this->countryRepo->restoreAll($this->country);
            
            if(is_string($countries)){
                return customResponse(404,[],$countries);
            }
            return customResponse(205,$countries );
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
    public function destroy(DeleteCountryRequest $request,$id)
    {
        try{
            $country= $this->countryRepo->destroy($id,$this->country);
                if(is_string($country)){
                    return customResponse(404,[],$country);
                }
                return customResponse(202,new CountryResource($country));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteCountryRequest $request,$id)
    {
        try{
            //to make force destroy for a Country must be this Country  not found in Country table  , must be found in trash Categories
            $country=$this->countryRepo->forceDelete($id,$this->country);
            if(is_string($country)){
                return customResponse(404,[],$country);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
