<?php
namespace Modules\Wallet\Repositories\Doctor\Resources;

use Modules\Wallet\Repositories\Doctor\Resources\WalletRepositoryInterface;
use Modules\Wallet\Entities\Traits\Doctor\WalletMethods;
use GeneralTrait;

class WalletRepository implements WalletRepositoryInterface
{
    use GeneralTrait,WalletMethods;
    public function all($request, $model){
        return   $this->balance($model);
    }

 
}
