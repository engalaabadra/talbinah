<?php
namespace Modules\Article\Entities\Traits;

trait ArticleAttributes{
    //Accessories
    public function getTrendingAttribute(){
        if(isset($this->attributes['trending']))  return  $this->attributes['trending'];
    }
    public function getOriginalTrendingAttribute(){
        if(isset($this->attributes['trending'])) {
            $value=$this->attributes['trending'];
            if($value==0){
                return trans('attributes.Not Trending');
            }elseif ($value==1) {
                return trans('attributes.Trending');
            }
        }
    }
}
