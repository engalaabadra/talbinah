<?php
namespace Modules\Keyword\Repositories\Additional;

use Modules\Keyword\Repositories\Additional\KeywordRepositoryInterface;
use Modules\Keyword\Entities\Traits\GeneralKeywordTrait;

class KeywordRepository implements KeywordRepositoryInterface
{
    use GeneralKeywordTrait;

    public function getKeywordsCategory($categoryId, $model){
        $keywordCategory = $model->where('id',$categoryId)->first();
        if(!$keywordCategory) return 404;
        return $keywordCategory->keywords;
    }
    public function getNewestKeywords($request, $model){
        if(page()) return $this->getNewestKeywordsPaginates($request, $model);
        else return $this->getNewestKeywordsAll($model);
    }
    public function getTrendingKeywords($request, $model){
        if(page()) return $this->getTrendingKeywordsPaginates($request, $model);
        else return $this->getTrendingKeywordsAll($model);
    }

    
 
}
