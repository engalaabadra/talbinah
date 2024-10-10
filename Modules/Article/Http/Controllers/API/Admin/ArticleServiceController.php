<?php
namespace Modules\Article\Http\Controllers\API\Admin;
use Modules\Article\Http\Controllers\API\Admin\ArticleController;
use Modules\Article\Services\Admin\ArticleService;
class ArticleServiceController extends ArticleController
{
    /**
     * @var ArticleService
     */
    protected $articleService;
      
    
    /**
     * ArticleServiceController constructor.
     *
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    //to calling method service for Article : 1. using object from it 2. register in app service container and using it
    
 }