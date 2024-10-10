<?php

namespace Modules\Article\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Repositories\Resources\ArticleRepository;
use Modules\Article\Entities\Article;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Article\Resources\ArticleResource;
class ArticleResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ArticleRepository
     */
    protected $articleRepo;
    /**
     * @var Article
     */
    protected $article;
    /**
     * @var Article
     */
    protected $user;
    
    /**
     * ArticleResourceController constructor.
     *
     * @param ArticleRepository $articles
     */
    public function __construct( Article $article, User $user,ArticleRepository $articleRepo)
    {
        $this->article = $article;
        $this->user = $user;
        $this->articleRepo = $articleRepo;
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $articles = $this->articleRepo->all($request,$this->article);
        if(page()) $data=getDataResponse(ArticleResource::collection($appointments));
        else $data=ArticleResource::collection($articles);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words){
        $articles=$this->articleRepo->search($this->article,$words,'title');
        if(page()) $data=getDataResponse(ArticleResource::collection($articles));
        else $data=ArticleResource::collection($articles);
        return successResponse(0,$data);
    }
}

