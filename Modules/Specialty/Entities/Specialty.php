<?php

namespace Modules\Specialty\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Specialty\Entities\Traits\GeneralSpecialtyTrait;

class Specialty extends Model
{
    use GeneralTrait,GeneralSpecialtyTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
