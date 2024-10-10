<?php

namespace Modules\Bookmark\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use GeneralTrait;
use Modules\Bookmark\Entities\Traits\GeneralBookmarkTrait;

class Bookmark extends Model
{
    use GeneralTrait,GeneralBookmarkTrait;
    protected $appends = ['original_active'];
    public $guarded = [];

}
