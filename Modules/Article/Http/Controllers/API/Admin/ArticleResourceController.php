<?php

namespace Modules\Article\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Http\Requests\Admin\StoreArticleRequest;
use Modules\Article\Http\Requests\Admin\UpdateArticleRequest;
use Modules\Article\Http\Requests\Admin\DeleteArticleRequest;
use App\Repositories\EloquentRepository;
use Modules\Article\Repositories\Admin\Resources\ArticleRepository;
use Modules\Article\Entities\Article;
use GeneralTrait;
use Modules\Article\Resources\Admin\ArticleResource;

class ArticleResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ArticleRepository
     */
    protected $articleRepo;
        /**
     * @var Article
     */
    protected $article;
    
    /**
     * ArticlesController constructor.
     *
     * @param ArticleRepository $articles
     */
    public function __construct(EloquentRepository $eloquentRepo, Article $article,ArticleRepository $articleRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->article = $article;
        $this->articleRepo = $articleRepo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article=  $this->articleRepo->store($request,$this->article);
        if(is_string($article)) return  clientError(0,$article);
        return successResponse(1,new ArticleResource($article));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request,$id)
    {
        $article= $this->articleRepo->update($request,$this->article,$id);
        if(is_numeric($article)) return  clientError(4,$article);
        return successResponse(2,new ArticleResource($article));
    }
}
