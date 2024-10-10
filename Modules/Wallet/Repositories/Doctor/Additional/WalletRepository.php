<?php
namespace Modules\Wallet\Repositories\Doctor\Additional;

use Modules\Wallet\Repositories\Doctor\Additional\WalletRepositoryInterface;
use Modules\Wallet\Entities\Traits\Doctor\WalletMethods;

class WalletRepository implements WalletRepositoryInterface
{
    use WalletMethods;
    public function withdraw($model1,$model2,$request){
        return $this->withdrawMethod($model1,$model2,$request);
    }
 
}
