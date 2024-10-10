<?php

namespace Modules\VisitChat\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\VisitChat\Entities\Traits\GeneralVisitChatTrait;
use GeneralTrait;

class VisitChat extends Model
{
    use GeneralTrait,GeneralVisitChatTrait;
    protected $table = 'visits_chats';
    protected $appends = ['original_active'];
    public $guarded = [];

}
