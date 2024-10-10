<?php

namespace Modules\Specialty\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Specialty\Http\Requests\StoreSpecialtyRequest;
use Modules\Specialty\Http\Requests\UpdateSpecialtyRequest;
use Modules\Specialty\Http\Requests\DeleteSpecialtyRequest;
use App\Repositories\EloquentRepository;
use Modules\Specialty\Repositories\Admin\Resources\SpecialtyRepository;
use Modules\Specialty\Entities\Specialty;
use GeneralTrait;
use Modules\Specialty\Resources\Admin\SpecialtyResource;

class SpecialtyResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var SpecialtyRepository
     */
    protected $specialtyRepo;
        /**
     * @var Specialty
     */
    protected $specialty;
    
    /**
     * SpecialtiesController constructor.
     *
     * @param SpecialtyRepository $specialties
     */
    public function __construct(EloquentRepository $eloquentRepo, Specialty $specialty,SpecialtyRepository $specialtyRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->specialty = $specialty;
        $this->specialtyRepo = $specialtyRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $specialties=$this->specialtyRepo->all($this->specialty,$lang);
        $data=SpecialtyResource::collection($specialties);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $specialties=$this->specialtyRepo->getAllPaginates($this->specialty,$request,$lang);
        $data=getDataResponse(SpecialtyResource::collection($specialties));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $specialties=$this->specialtyRepo->search($this->specialty,$words,$col);
        $data=getDataResponse(SpecialtyResource::collection($specialties));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $specialties=$this->specialtyRepo->trash($this->specialty,$request);
        if(is_string($specialties)) return  clientError(4,$specialties);
        $data=getDataResponse(SpecialtyResource::collection($specialties));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialtyRequest $request)
    {
        $specialty=  $this->specialtyRepo->store($request,$this->specialty);
        if(is_string($specialty)) return  clientError(0,$specialty);
        return successResponse(1,new SpecialtyResource($specialty));
    }
    public function storeTrans(StoreSpecialtyRequest $request,$id,$lang)
    {
        $specialty=  $this->specialtyRepo->storeTrans($request,$this->specialty,$id,$lang);
        return successResponse(1,new SpecialtyResource($specialty));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialty=$this->specialtyRepo->show($id,$this->specialty);
        if(is_numeric($specialty)) return  clientError(4,$specialty);
        return successResponse(0,new SpecialtyResource($specialty));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialtyRequest $request,$id)
    {
        $specialty= $this->specialtyRepo->update($request,$this->specialty,$id);
        if(is_numeric($specialty)) return  clientError(4,$specialty);
        return successResponse(2,new SpecialtyResource($specialty));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $specialty =  $this->specialtyRepo->restore($id,$this->specialty);
        if(is_string($specialty)) return  clientError(4,$specialty);
        return successResponse(5,new SpecialtyResource($specialty));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $specialties =  $this->specialtyRepo->restoreAll($this->specialty);
        if(is_string($specialty)) return  clientError(4,$specialty);
        return customResponse(205,$specialties );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteSpecialtyRequest $request,$id)
    {
        $specialty= $this->specialtyRepo->destroy($id,$this->specialty);
        if(is_numeric($specialty)) return  clientError(4,$specialty);
        return successResponse(2,new SpecialtyResource($specialty));  
    }
    public function forceDelete(DeleteSpecialtyRequest $request,$id)
    {
        //to make force destroy for a Specialty must be this Specialty  not found in Specialties table  , must be found in trash Categories
        $specialty=$this->specialtyRepo->forceDelete($id,$this->specialty);
        if(is_numeric($specialty)) return  clientError(4,$specialty);
        return successResponse(4,new SpecialtyResource($specialty));
    }

}
