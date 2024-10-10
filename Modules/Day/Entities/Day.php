<?php

namespace Modules\Day\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneralTrait;
use Modules\Day\Entities\Traits\GeneralDayTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use GeneralTrait,GeneralDayTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
