<?php

namespace Modules\VisitCall\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VisitCall\Repositories\User\Additional\VisitCallRepository;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\VisitCall\Resources\User\VisitCallResource;
class VisitCallController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitCallRepository
     */
    protected $visitRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * VisitCallController constructor.
     *
     * @param VisitCallRepository $visits
     */
    public function __construct( Reservation $reservation,VisitCallRepository $visitRepo)
    {
        $this->reservation = $reservation;
        $this->visitRepo = $visitRepo;
    }


}
