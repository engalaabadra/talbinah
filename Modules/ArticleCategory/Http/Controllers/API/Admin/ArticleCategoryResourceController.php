<?php

namespace Modules\ArticleCategory\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleCategory\Http\Requests\Admin\StoreArticleCategoryRequest;
use App\Repositories\EloquentRepository;
use Modules\ArticleCategory\Repositories\Admin\Resources\ArticleCategoryRepository;
use Modules\ArticleCategory\Entities\ArticleCategory;
use GeneralTrait;
use Modules\ArticleCategory\Resources\Admin\ArticleCategoryResource;

class ArticleCategoryResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ArticleCategoryRepository
     */
    protected $articleCategoryRepo;
        /**
     * @var ArticleCategory
     */
    protected $articleCategory;
    
    /**
     * ArticleCategorysController constructor.
     *
     * @param ArticleCategoryRepository $articleCategorys
     */
    public function __construct(EloquentRepository $eloquentRepo, ArticleCategory $articleCategory,ArticleCategoryRepository $articleCategoryRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->articleCategory = $articleCategory;
        $this->articleCategoryRepo = $articleCategoryRepo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleCategoryRequest $request)
    {
        $articleCategory=  $this->articleCategoryRepo->store($request,$this->articleCategory);
        if(is_string($articleCategory)) return  clientError(0,$articleCategory);
        return successResponse(1,new ArticleCategoryResource($articleCategory));
    }
}
