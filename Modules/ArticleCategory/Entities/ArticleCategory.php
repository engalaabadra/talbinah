<?php

namespace Modules\ArticleCategory\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\ArticleCategory\Entities\Traits\GeneralArticleCategoryTrait;

class ArticleCategory extends Model
{
    use GeneralTrait,GeneralArticleCategoryTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
