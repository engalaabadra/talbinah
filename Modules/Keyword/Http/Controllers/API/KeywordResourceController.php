<?php

namespace Modules\Keyword\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Keyword\Repositories\Resources\KeywordRepository;
use Modules\Keyword\Entities\Keyword;
use GeneralTrait;
use Modules\Keyword\Resources\KeywordResource;
class KeywordResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var KeywordRepository
     */
    protected $keywordRepo;
        /**
     * @var Keyword
     */
    protected $keyword;
    
    /**
     * KeywordResourceController constructor.
     *
     * @param KeywordRepository $keywords
     */
    public function __construct( Keyword $keyword,KeywordRepository $keywordRepo)
    {
        $this->keyword = $keyword;
        $this->keywordRepo = $keywordRepo;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $keywords = $this->keywordRepo->all($request,$this->keyword);
        if(page()) $data=getDataResponse(KeywordResource::collection($keywords));
        else $data=KeywordResource::collection($keywords);
        return successResponse(0,$data);
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keyword=$this->keywordRepo->show($id,$this->keyword);
        if(is_numeric($keyword)) return  clientError(4,$keyword);
        return successResponse(0,new KeywordResource($keyword));
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words){
        $keywords=$this->keywordRepo->search($this->keyword,$words,'title');
        if(page()) $data=getDataResponse(KeywordResource::collection($keywords));
        else $data=KeywordResource::collection($keywords);
        return successResponse(0,$data);
    }
}
