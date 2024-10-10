<?php
namespace Modules\Keyword\Entities\Traits;

trait KeywordScopes{
    public function scopeTrending($query)
    {
        return $query->where('trending', 1);
    }
}
