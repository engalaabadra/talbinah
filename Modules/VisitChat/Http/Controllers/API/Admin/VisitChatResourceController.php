<?php

namespace Modules\VisitChat\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VisitChat\Http\Requests\StoreVisitChatRequest;
use Modules\VisitChat\Http\Requests\UpdateVisitChatRequest;
use Modules\VisitChat\Http\Requests\DeleteVisitChatRequest;
use App\Repositories\EloquentRepository;
use Modules\VisitChat\Repositories\Admin\Resources\VisitChatRepository;
use Modules\VisitChat\Entities\VisitChat;
use GeneralTrait;
use Modules\VisitChat\Resources\Admin\VisitChatResource;

class VisitChatResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var VisitChatRepository
     */
    protected $visitRepo;
        /**
     * @var VisitChat
     */
    protected $visit;
    
    /**
     * VisitChatsController constructor.
     *
     * @param VisitChatRepository $visits
     */
    public function __construct(EloquentRepository $eloquentRepo, VisitChat $visit,VisitChatRepository $visitRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->visit = $visit;
        $this->visitRepo = $visitRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang=null){
        $visits=$this->visitRepo->all($this->visit,$lang);
        $data=VisitChatResource::collection($visits);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPaginates(Request $request,$lang=null){
        $visits=$this->visitRepo->getAllPaginates($this->visit,$request,$lang);
        $data=getDataResponse(VisitChatResource::collection($visits));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col){
        $visits=$this->visitRepo->search($this->visit,$words,$col);
        $data=getDataResponse(VisitChatResource::collection($visits));
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $visits=$this->visitRepo->trash($this->visit,$request);
        if(is_string($visits)) return  clientError(4,$visits);
        $data=getDataResponse(VisitChatResource::collection($visits));
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitChatRequest $request)
    {
        $visit=  $this->visitRepo->store($request,$this->visit);
        if(is_string($visit)) return  clientError(0,$visit);
        return successResponse(1,new VisitChatResource($visit));
    }
    public function storeTrans(StoreVisitChatRequest $request,$id,$lang)
    {
        $visit=  $this->visitRepo->storeTrans($request,$this->visit,$id,$lang);
        return successResponse(1,new VisitChatResource($visit));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit=$this->visitRepo->show($id,$this->visit);
        if(is_numeric($visit)) return  clientError(4,$visit);
        return successResponse(0,new VisitChatResource($visit));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitChatRequest $request,$id)
    {
        $visit= $this->visitRepo->update($request,$this->visit,$id);
        if(is_numeric($visit)) return  clientError(4,$visit);
        return successResponse(2,new VisitChatResource($visit));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $visit =  $this->visitRepo->restore($id,$this->visit);
        if(is_string($visit)) return  clientError(4,$visit);
        return successResponse(5,new VisitChatResource($visit));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $visits =  $this->visitRepo->restoreAll($this->visit);
        if(is_string($visit)) return  clientError(4,$visit);
        return customResponse(205,$visits );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteVisitChatRequest $request,$id)
    {
        $visit= $this->visitRepo->destroy($id,$this->visit);
        if(is_numeric($visit)) return  clientError(4,$visit);
        return successResponse(2,new VisitChatResource($visit));  
    }
    public function forceDelete(DeleteVisitChatRequest $request,$id)
    {
        //to make force destroy for a VisitChat must be this VisitChat  not found in VisitChats table  , must be found in trash Categories
        $visit=$this->visitRepo->forceDelete($id,$this->visit);
        if(is_numeric($visit)) return  clientError(4,$visit);
        return successResponse(4,new VisitChatResource($visit));
    }

}
