<?php

namespace Modules\Duration\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use GeneralTrait;
use Modules\Duration\Entities\Traits\GeneralDurationTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Duration extends BaseModel
{
    use GeneralTrait,GeneralDurationTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
