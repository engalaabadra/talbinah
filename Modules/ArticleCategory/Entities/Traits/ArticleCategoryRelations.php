<?php
namespace Modules\ArticleCategory\Entities\Traits;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
use Modules\Day\Entities\Day;
use Modules\Time\Entities\Time;
use Modules\Payment\Entities\Payment;
use Modules\Reservation\Entities\Reservation;
use Modules\Communication\Entities\Communication;
use Modules\Article\Entities\Article;

trait ArticleCategoryRelations{
    
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function duration(){
        return $this->belongsTo(Duration::class);
    }
    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
