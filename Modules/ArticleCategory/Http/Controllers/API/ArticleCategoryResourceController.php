<?php

namespace Modules\ArticleCategory\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleCategory\Repositories\Resources\ArticleCategoryRepository;
use Modules\ArticleCategory\Entities\ArticleCategory;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\ArticleCategory\Resources\ArticleCategoryResource;
class ArticleCategoryResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ArticleCategoryRepository
     */
    protected $articleCategoryRepo;
    /**
     * @var ArticleCategory
     */
    protected $articleCategory;
    /**
     * @var ArticleCategory
     */
    protected $user;
    
    /**
     * ArticleCategoryController constructor.
     *
     * @param ArticleCategoryRepository $articleCategorys
     */
    public function __construct( ArticleCategory $articleCategory, User $user,ArticleCategoryRepository $articleCategoryRepo)
    {
        $this->articleCategory = $articleCategory;
        $this->user = $user;
        $this->articleCategoryRepo = $articleCategoryRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $articleCategories=$this->articleCategoryRepo->all($request, $this->articleCategory);
        if(page()) $data = getDataResponse(ArticleCategoryResource::collection($articleCategories));
        else $data = ArticleCategoryResource::collection($articleCategories);
        return successResponse(0,$data);
    }


}
