<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Article\Entities\Traits\GeneralArticleTrait;

class Article extends Model
{
    use GeneralTrait,GeneralArticleTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
