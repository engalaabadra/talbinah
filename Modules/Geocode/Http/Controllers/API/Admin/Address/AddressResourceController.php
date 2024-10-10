<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Address\StoreAddressRequest;
use Modules\Geocode\Http\Requests\Address\UpdateAddressRequest;
use Modules\Geocode\Http\Requests\Address\DeleteAddressRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\Admin\Address\Resources\AddressRepository;
use Modules\Geocode\Entities\Address;
use GeneralTrait;
use Modules\Geocode\Resources\AddressResource;
class AddressResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AddressRepository
     */
    protected $addressRepo;
        /**
     * @var Address
     */
    protected $address;
    
    /**
     * AddressController constructor.
     *
     * @param AddressRepository $addresses
     */
    public function __construct(EloquentRepository $eloquentRepo, Address $address,AddressRepository $addressRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->address = $address;
        $this->addressRepo = $addressRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        try{
            $addresses=$this->addressRepo->all($this->address,$lang);
            $data=AddressResource::collection($addresses);

            return customResponse(200,$data);

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function getAllPaginates(Request $request,$lang=null){
        try{
            $addresses=$this->addressRepo->getAllPaginates($this->address,$request,$lang);
            $data=AddressResource::collection($addresses)->getDataResponse();
            return customResponse(200,$data);
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }

    

    // methods for trash
    public function trash(Request $request){
        try{
            $addresses=$this->addressRepo->trash($this->address,$request);
            if(is_string($addresses)){
                return customResponse(404,[],$addresses);
            }
            $data=AddressResource::collection($addresses)->getDataResponse();
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
    public function store(StoreAddressRequest $request)
    {
        try{
            $address=  $this->addressRepo->store($request,$this->address);
            if(is_string($address)){
                return customResponse(400,[],$address);
            }
            
            return customResponse(201, new AddressResource($address));
        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function storeTrans(StoreAddressRequest $request,$id,$lang)
    {
        try{
            $address=  $this->addressRepo->storeTrans($request,$this->address,$id,$lang);

            return customResponse(201, new AddressResource($address));
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
            $address=$this->addressRepo->show($id,$this->address);
            if(is_string($address)){
                return customResponse(404,[],$address);
            }
            return customResponse(200,new AddressResource($address));
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
    public function update(UpdateAddressRequest $request,$id)
    {
        try{
            $address= $this->addressRepo->update($request,$id,$this->address);
                
                if(is_string($address)){
                    return customResponse(404,[],$address);
                }
                return customResponse(202, new AddressResource($address));
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

    //methods for restoring
    public function restore($id){
        try{
            $address =  $this->addressRepo->restore($id,$this->address);
            
            if(is_string($address)){
                return customResponse(404,[],$address);
            }
            return customResponse(205, new AddressResource($address));

        }catch(\Exception $ex){
            return customResponse(500);
        }

    }
    public function restoreAll(){
        try{
            $addresses =  $this->addressRepo->restoreAll($this->address);
            
            if(is_string($addresses)){
                return customResponse(404,[],$addresses);
            }
            return customResponse(205,$addresses );
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
    public function destroy(DeleteAddressRequest $request,$id)
    {
        try{
            $address= $this->addressRepo->destroy($id,$this->address);
                if(is_string($address)){
                    return customResponse(404,[],$address);
                }
                return customResponse(202,new AddressResource($address));
        }catch(\Exception $ex){
            return customResponse(500);
        }
       
    }
    public function forceDelete(DeleteAddressRequest $request,$id)
    {
        try{
            //to make force destroy for a Address must be this Address  not found in Address table  , must be found in trash Categories
            $address=$this->addressRepo->forceDelete($id,$this->address);
            if(is_string($address)){
                return customResponse(404,[],$address);
            }
            return customResponse(202);
        }catch(\Exception $ex){
            return customResponse(500);
        }
    }

}
