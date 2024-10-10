<?php

namespace Modules\Keyword\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Keyword\Repositories\Admin\Additional\KeywordRepository;
use Modules\Keyword\Entities\Keyword;
use GeneralTrait;
use Modules\Keyword\Http\Controllers\API\Admin\KeywordResourceController;
class KeywordController extends KeywordResourceController
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
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Keyword $keyword
     * @param KeywordRepository $keywordRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Keyword $keyword,KeywordRepository $keywordRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->keyword = $keyword;
        $this->keywordRepo = $keywordRepo;
    }

}
