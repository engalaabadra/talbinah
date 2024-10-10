<?php
namespace Modules\Communication\Entities\Traits;
use Modules\Day\Entities\Day;
use App\Models\Image;

trait CommunicationRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
