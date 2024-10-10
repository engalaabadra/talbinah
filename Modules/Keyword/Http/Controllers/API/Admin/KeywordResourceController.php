<?php

namespace Modules\Keyword\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Keyword\Http\Requests\Admin\StoreKeywordRequest;
use Modules\Keyword\Http\Requests\Admin\UpdateKeywordRequest;
use Modules\Keyword\Http\Requests\Admin\DeleteKeywordRequest;
use App\Repositories\EloquentRepository;
use Modules\Keyword\Repositories\Admin\Resources\KeywordRepository;
use Modules\Keyword\Entities\Keyword;
use GeneralTrait;
use Modules\Keyword\Resources\Admin\KeywordResource;

class KeywordResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var KeywordRepository
     */
    protected $keywordRepo;
        /**
     * @var Keyword
     */
    protected $keyword;
    
    /**
     * KeywordsController constructor.
     *
     * @param KeywordRepository $keywords
     */
    public function __construct(EloquentRepository $eloquentRepo, Keyword $keyword,KeywordRepository $keywordRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->keyword = $keyword;
        $this->keywordRepo = $keywordRepo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKeywordRequest $request)
    {
        $keyword=  $this->keywordRepo->store($request,$this->keyword);
        if(is_string($keyword)) return  clientError(0,$keyword);
        return successResponse(1,new KeywordResource($keyword));
    }
}
