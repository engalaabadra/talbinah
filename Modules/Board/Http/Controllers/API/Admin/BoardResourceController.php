<?php

namespace Modules\Board\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Modules\Board\Http\Requests\StoreBoardRequest;
use Modules\Board\Http\Requests\UpdateBoardRequest;
use Modules\Board\Http\Requests\DeleteBoardRequest;
use App\Repositories\EloquentRepository;
use Modules\Board\Repositories\Admin\Resources\BoardRepository;
use Modules\Board\Entities\Board;
use GeneralTrait;
use Modules\Board\Resources\Admin\BoardResource;

class BoardResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BoardRepository
     */
    protected $boardRepo;
        /**
     * @var Board
     */
    protected $board;
    
    /**
     * BoardsController constructor.
     *
     * @param BoardRepository $boards
     */
    public function __construct(EloquentRepository $eloquentRepo, Board $board,BoardRepository $boardRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->board = $board;
        $this->boardRepo = $boardRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $boards=$this->boardRepo->all($request, $this->board);
        $data=getDataResponse(BoardResource::collection($boards));
        return successResponse(0,$data);
    }

    // methods for trash
    public function trash(Request $request){
        $boards=$this->boardRepo->trash($this->board,$request);
        if(is_string($boards)) return  clientError(4,$boards);
        $data=BoardResource::collection($boards)->getDataResponse();
        return successResponse(0,$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $board=  $this->boardRepo->store($request,$this->board);
        if(is_string($board)) return  clientError(0,$board);
        return successResponse(1,new BoardResource($board));
    }
    public function storeTrans(StoreBoardRequest $request,$id,$lang)
    {
        $board=  $this->boardRepo->storeTrans($request,$this->board,$id,$lang);
        return successResponse(1,new BoardResource($board));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board=$this->boardRepo->show($id,$this->board);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(0,new BoardResource($board));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request,$id)
    {
        $board= $this->boardRepo->update($request,$this->board,$id);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(2,new BoardResource($board));
    }

    //methods for restoring
    public function restore($id){
        $board =  $this->boardRepo->restore($id,$this->board);
        if(is_string($board)) return  clientError(4,$board);
        return successResponse(5,new BoardResource($board));
    }
    public function restoreAll(){
        $boards =  $this->boardRepo->restoreAll($this->board);
        if(is_string($board)) return  clientError(4,$board);
        return customResponse(205,$boards );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBoardRequest $request,$id)
    {
        $board= $this->boardRepo->destroy($id,$this->board);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(2,new BoardResource($board));  
    }
    public function forceDelete(DeleteBoardRequest $request,$id)
    {
        //to make force destroy for a Board must be this Board  not found in Boards table  , must be found in trash Categories
        $board=$this->boardRepo->forceDelete($id,$this->board);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(4,new BoardResource($board));
    }

}
