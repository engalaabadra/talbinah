<?php
namespace Modules\ArticleCategory\Http\Controllers\API\Admin;
use Modules\ArticleCategory\Http\Controllers\API\Admin\ArticleCategoryController;
use Modules\ArticleCategory\Services\Admin\ArticleCategoryService;
class ArticleCategoryServiceController extends ArticleCategoryController
{
    /**
     * @var ArticleCategoryService
     */
    protected $articleCategoryService;
      
    
    /**
     * ArticleCategoryServiceController constructor.
     *
     */
    public function __construct(ArticleCategoryService $articleCategoryService)
    {
        $this->articleCategoryService = $articleCategoryService;
    }

    //to calling method service for ArticleCategory : 1. using object from it 2. register in app service container and using it
    
 }