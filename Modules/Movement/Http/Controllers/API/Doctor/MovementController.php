<?php

namespace Modules\Movement\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Movement\Repositories\Doctor\Additional\MovementRepository;
use Modules\Movement\Entities\Movement;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use Modules\RequestWithdraw\Entities\RequestWithdraw;
use GeneralTrait;
use Modules\Movement\Resources\Doctor\MovementResource;
use Modules\Movement\Http\Requests\DeleteFromMovementRequest;

class MovementController extends Controller
{
    use GeneralTrait;
    /**
     * @var MovementRepository
     */
    protected $movementRepo;
    /**
     * @var Movement
     */
    protected $movement;

    /**
     * @var RequestWithdraw
     */
    protected $requestWithdraw;
    
    /**
     * MovementController constructor.
     *
     * @param MovementRepository $movements
     */
    public function __construct( movement $movement,RequestWithdrawing $requestWithdrawing,MovementRepository $movementRepo)
    {
        $this->movement = $movement;
        $this->requestWithdrawing = $requestWithdrawing;
        $this->movementRepo = $movementRepo;
    }
}
