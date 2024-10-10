<?php

namespace Modules\ArticleCategory\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\ArticleCategory\Repositories\Admin\Additional\ArticleCategoryRepository;
use Modules\ArticleCategory\Entities\ArticleCategory;
use GeneralTrait;
use Modules\ArticleCategory\Http\Controllers\API\Admin\ArticleCategoryResourceController;
class ArticleCategoryController extends ArticleCategoryResourceController
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
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param ArticleCategory $articleCategory
     * @param ArticleCategoryRepository $articleCategoryRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, ArticleCategory $articleCategory,ArticleCategoryRepository $articleCategoryRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->articleCategory = $articleCategory;
        $this->articleCategoryRepo = $articleCategoryRepo;
    }

}
