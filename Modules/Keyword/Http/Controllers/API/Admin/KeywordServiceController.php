<?php
namespace Modules\Keyword\Http\Controllers\API\Admin;
use Modules\Keyword\Http\Controllers\API\Admin\KeywordController;
use Modules\Keyword\Services\Admin\KeywordService;
class KeywordServiceController extends KeywordController
{
    /**
     * @var KeywordService
     */
    protected $keywordService;
      
    
    /**
     * KeywordServiceController constructor.
     *
     */
    public function __construct(KeywordService $keywordService)
    {
        $this->keywordService = $keywordService;
    }

    //to calling method service for Keyword : 1. using object from it 2. register in app service container and using it
    
 }