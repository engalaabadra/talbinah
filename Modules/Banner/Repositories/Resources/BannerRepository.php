<?php
namespace Modules\Banner\Repositories\Resources;

use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\Resources\BannerRepositoryInterface;
use Modules\Banner\Entities\Traits\GeneralBannerTrait;
use GeneralTrait;

class BannerRepository extends EloquentRepository implements BannerRepositoryInterface
{
    use GeneralBannerTrait,GeneralTrait;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesData($request, $model);
        else return $this->getAllData($model);
    }

}
