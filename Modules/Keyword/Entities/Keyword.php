<?php

namespace Modules\Keyword\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Keyword\Entities\Traits\GeneralKeywordTrait;

class Keyword extends Model
{
    use GeneralTrait,GeneralKeywordTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];
    
}
