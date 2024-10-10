<?php

namespace Modules\Wallet\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Wallet\Repositories\Doctor\Resources\WalletRepository;
use Modules\Wallet\Entities\Wallet;
use Illuminate\Http\Request;
use GeneralTrait;
use Modules\Wallet\Entities\Traits\Doctor\WalletMethods;
use Modules\Wallet\Resources\Doctor\WalletResource;

class WalletResourceController extends Controller
{
    use GeneralTrait,WalletMethods;
    /**
     * @var WalletRepository
     */
    protected $walletRepo;
        /**
     * @var Wallet
     */
    protected $wallet;
    
    /**
     * WalletResourceController constructor.
     *
     * @param WalletRepository $wallets
     */
    public function __construct( Wallet $wallet,WalletRepository $walletRepo)
    {
        $this->wallet = $wallet;
        $this->walletRepo = $walletRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $wallet=$this->balance($this->wallet);
        $data = new WalletResource($wallet);
        return successResponse(0,$data);
    }
    
}
