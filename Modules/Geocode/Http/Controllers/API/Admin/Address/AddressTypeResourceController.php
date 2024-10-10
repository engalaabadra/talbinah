<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\AddressType\StoreAddressTypeRequest;
use Modules\Geocode\Http\Requests\AddressType\UpdateAddressTypeRequest;
use Modules\Geocode\Http\Requests\AddressType\DeleteAddressTypeRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\AddressType\Resources\AddressTypeRepository;
use Modules\Geocode\Entities\AddressType;
use GeneralTrait;
use Modules\Geocode\Resources\AddressTypeResource;
class AddressTypeResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AddressTypeRepository
     */
    protected $addressTypeRepo;
        /**
     * @var AddressType
     */
    protected $addressType;
    
    /**
     * AddressController constructor.
     *
     * @param AddressTypeRepository $addressTypees
     */
    public function __construct(EloquentRepository $eloquentRepo, AddressType $addressType,AddressTypeRepository $addressTypeRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->addressType = $addressType;
        $this->addressTypeRepo = $addressTypeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $addressTypees=$this->addressTypeRepo->all($this->addressType,$lang);
            $data=AddressTypeResource::collection($addressTypees);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        //try{
            $addressTypees=$this->addressTypeRepo->getAllPaginates($this->addressType,$request,$lang);
            $data=AddressTypeResource::collection($addressTypees)->getDataResponse();
            return customResponse(200,$data);
        // }catch(\Exception $ex){
        //     return customResponse(500);
        // }

    }

    

    // methods for trash
    public function trash(Request $request){
        try{
            $addressTypees=$this->addressTypeRepo->trash($this->addressType,$request);
            if(is_string($addressTypees)){
                return customResponse(404,[],$addressTypees);
            }
            $data=AddressTypeResource::collection($addressTypees)->getDataResponse();
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
    public function store(StoreAddressTypeRequest $request)
    {
        try{
            $addressType=  $this->addressTypeRepo->store($request,$this->addressType);
            if(is_string($addressType)){
                return customResponse(400,[],$addressType);
            }
            
            return customResponse(201, new AddressTypeResource($addressType));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreAddressTypeRequest $request,$id,$lang)
    {
        try{
            $addressType=  $this->addressTypeRepo->storeTrans($request,$this->addressType,$id,$lang);

            return customResponse(201, new AddressTypeResource($addressType));
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
            $addressType=$this->addressTypeRepo->show($id,$this->addressType);
            if(is_string($addressType)){
                return customResponse(404,[],$addressType);
            }
            return customResponse(200,new AddressTypeResource($addressType));
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
    public function update(UpdateAddressTypeRequest $request,$id)
    {
        try{
            $addressType= $this->addressTypeRepo->update($request,$id,$this->addressType);
                
                if(is_string($addressType)){
                    return customResponse(404,[],$addressType);
                }
                return customResponse(202, new AddressTypeResource($addressType));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $addressType =  $this->addressTypeRepo->restore($id,$this->addressType);
            
            if(is_string($addressType)){
                return customResponse(404,[],$addressType);
            }
            return customResponse(205, new AddressTypeResource($addressType));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $addressTypees =  $this->addressTypeRepo->restoreAll($this->addressType);
            
            if(is_string($addressTypees)){
                return customResponse(404,[],$addressTypees);
            }
            return customResponse(205,$addressTypees );
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
    public function destroy(DeleteAddressTypeRequest $request,$id)
    {
        try{
            $addressType= $this->addressTypeRepo->destroy($id,$this->addressType);
                if(is_string($addressType)){
                    return customResponse(404,[],$addressType);
                }
                return customResponse(202,new AddressTypeResource($addressType));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteAddressTypeRequest $request,$id)
    {
        try{
            //to make force destroy for a Address must be this Address  not found in Address table  , must be found in trash Categories
            $addressType=$this->addressTypeRepo->forceDelete($id,$this->addressType);
            if(is_string($addressType)){
                return customResponse(404,[],$addressType);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
