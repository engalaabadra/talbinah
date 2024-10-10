<?php
namespace Modules\Auth\Repositories\Type\User\Doctor;
// namespace Modules\Auth\Repositories;

use Modules\Auth\Repositories\Type\User\Doctor\DoctorRepositoryInterface;
// use Modules\Auth\Repositories\DoctorRepositoryInterface;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Modules\Review\Entities\Review;
use Modules\Favorite\Entities\Traits\Methods\FavoriteMethods;
use GeneralTrait;
use App\Repositories\EloquentRepository;
use Modules\Auth\Entities\User;
use DB;
class DoctorRepository extends EloquentRepository implements DoctorRepositoryInterface
{
    use GeneralUserTrait,GeneralTrait;
    public function all($request, $model){
        if(page())return $this->getPaginateDataFilter(); 
        else return $this->getAllDataFilter();
    }

    public function getAllTopDoctors($model){//model:review
        return $this->topDoctors($model);
    }

}
