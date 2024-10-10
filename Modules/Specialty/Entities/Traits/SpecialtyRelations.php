<?php
namespace Modules\Specialty\Entities\Traits;
use Modules\Auth\Entities\User;
use App\Models\Image;

trait SpecialtyRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function doctors(){
        return $this->belongsToMany(User::class,'specialties_doctors','specialty_id','doctor_id');
    }
}
