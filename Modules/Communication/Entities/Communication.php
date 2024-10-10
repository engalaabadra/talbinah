<?php

namespace Modules\Communication\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneralTrait;
use Modules\Communication\Entities\Traits\GeneralCommunicationTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Communication extends Model
{
    use GeneralTrait,GeneralCommunicationTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
