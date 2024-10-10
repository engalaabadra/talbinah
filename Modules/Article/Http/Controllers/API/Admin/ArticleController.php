<?php

namespace Modules\Article\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Article\Repositories\Admin\Additional\ArticleRepository;
use Modules\Article\Entities\Article;
use GeneralTrait;
use Modules\Article\Http\Controllers\API\Admin\ArticleResourceController;
class ArticleController extends ArticleResourceController
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
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Article $article
     * @param ArticleRepository $articleRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Article $article,ArticleRepository $articleRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->article = $article;
        $this->articleRepo = $articleRepo;
    }

}
