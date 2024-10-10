<?php
namespace Modules\Favorite\Entities\Traits;
use Modules\Auth\Entities\User;
trait FavoriteRelations{
    
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
