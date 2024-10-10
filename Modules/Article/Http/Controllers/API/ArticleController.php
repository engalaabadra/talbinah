<?php

namespace Modules\Article\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Repositories\Additional\ArticleRepository;
use Modules\ArticleCategory\Entities\ArticleCategory;
use Modules\Article\Entities\Article;
use GeneralTrait;
use Modules\Article\Resources\ArticleResource;
class ArticleController extends Controller
{
    use GeneralTrait;
    /**
     * @var ArticleRepository
     */
    protected $articleRepo;
    /**
     * @var ArticleCategory
     */
    protected $articleCategory;
    /**
     * @var Article
     */
    protected $article;
    
    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articles
     */
    public function __construct( ArticleCategory $articleCategory,Article $article,ArticleRepository $articleRepo)
    {
        $this->articleCategory = $articleCategory;
        $this->article = $article;
        $this->articleRepo = $articleRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticlesCategory($categoryId){
        $articles = $this->articleRepo->getArticlesCategory($categoryId,$this->articleCategory);
        if(is_numeric($articles)) return clientError(4);
        if(page()) $data=getDataResponse(ArticleResource::collection($articles));
        else $data=ArticleResource::collection($articles);
        return successResponse(0,$data);
    }
  
    public function getNewestArticles(Request $request){
        $articles = $this->articleRepo->getNewestArticles($request , $this->article);
        if(page()) $data=getDataResponse(ArticleResource::collection($articles));
        else $data=ArticleResource::collection($articles);
        return successResponse(0,$data);
    }
    public function getTrendingArticles(Request $request){
        $articles = $this->articleRepo->getTrendingArticles($request , $this->article);
        if(page()) $data=getDataResponse(ArticleResource::collection($articles));
        else $data=ArticleResource::collection($articles);
        return successResponse(0,$data);
    }

}
