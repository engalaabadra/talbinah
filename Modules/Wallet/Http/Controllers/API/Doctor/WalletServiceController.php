<?php

namespace Modules\Wallet\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Wallet\Entities\Wallet;
use GeneralTrait;
use Modules\Wallet\Services\Doctor\WalletService;
class WalletServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var WalletService
     */
    protected $walletService;
        /**
     * @var Wallet
     */
    protected $wallet;
    
    /**
     * WalletServiceController constructor.
     *
     * @param WalletService $wallets
     */
    public function __construct( Wallet $wallet,WalletService $walletService)
    {
        $this->wallet = $wallet;
        $this->walletService = $walletService;
    }

}
