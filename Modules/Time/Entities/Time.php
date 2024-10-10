<?php

namespace Modules\Time\Entities;

use GeneralTrait;
use Modules\Time\Entities\Traits\GeneralTimeTrait;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use GeneralTrait,GeneralTimeTrait;
    protected $appends = ['original_active'];
    public $guarded = [];
  
}
