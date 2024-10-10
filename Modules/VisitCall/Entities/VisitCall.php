<?php

namespace Modules\VisitCall\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\VisitCall\Entities\Traits\GeneralVisitCallTrait;
use GeneralTrait;

class VisitCall extends Model
{
    use GeneralTrait,GeneralVisitCallTrait;
    protected $table = 'visits_calls';
    protected $appends = ['original_active'];
    public $guarded = [];

}
