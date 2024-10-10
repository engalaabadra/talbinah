<?php

namespace Modules\Keyword\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Keyword\Repositories\Additional\KeywordRepository;
use Modules\Keyword\Entities\Keyword;
use GeneralTrait;
use Modules\KeywordCategory\Entities\KeywordCategory;
use Modules\Keyword\Resources\KeywordResource;
class KeywordController extends Controller
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
     * KeywordController constructor.
     *
     * @param KeywordRepository $keywords
     */
    public function __construct(KeywordCategory $keywordCategory, Keyword $keyword,KeywordRepository $keywordRepo)
    {
        $this->keyword = $keyword;
        $this->keywordCategory = $keywordCategory;
        $this->keywordRepo = $keywordRepo;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKeywordsCategory($categoryId){
        $keywords = $this->keywordRepo->getKeywordsCategory($categoryId,$this->keywordCategory);
        if(is_numeric($keywords)) return clientError(4);
        if(page()) $data=getDataResponse(KeywordResource::collection($keywords));
        else $data=KeywordResource::collection($keywords);
        return successResponse(0,$data);
    }
  
    public function getNewestKeywords(Request $request){
        $keywords = $this->keywordRepo->getNewestKeywords($request , $this->keyword);
        if(page()) $data=getDataResponse(KeywordResource::collection($keywords));
        else $data=KeywordResource::collection($keywords);
        return successResponse(0,$data);
    }

    public function getTrendingKeywords(Request $request){
        $keywords = $this->keywordRepo->getTrendingKeywords($request , $this->keyword);
        if(page()) $data=getDataResponse(KeywordResource::collection($keywords));
        else $data=KeywordResource::collection($keywords);
        return successResponse(0,$data);
    }
}
