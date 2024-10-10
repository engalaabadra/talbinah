<?php

namespace Modules\Movement\Http\Controllers\API\Doctor;
use App\Http\Controllers\Controller;
use Modules\Movement\Entities\Movement;
use GeneralTrait;
use Modules\Movement\Services\Doctor\MovementService;
class MovementServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var MovementService
     */
    protected $movementService;
        /**
     * @var Movement
     */
    protected $movement;
    
    /**
     * MovementServiceController constructor.
     *
     * @param MovementService $movements
     */
    public function __construct( Movement $movement,MovementService $movementService)
    {
        $this->movement = $movement;
        $this->movementService = $movementService;
    }

}
