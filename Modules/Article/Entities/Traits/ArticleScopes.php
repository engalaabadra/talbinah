<?php
namespace Modules\Article\Entities\Traits;

trait ArticleScopes{
    public function scopeTrending($query)
    {
        return $query->where('trending', 1);
    }
}
