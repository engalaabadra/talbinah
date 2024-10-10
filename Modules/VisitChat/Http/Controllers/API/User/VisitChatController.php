<?php

namespace Modules\VisitChat\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VisitChat\Repositories\User\Additional\VisitChatRepository;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\VisitChat\Resources\User\VisitChatResource;

class VisitChatController extends Controller
{
    use GeneralTrait;
    /**
     * @var VisitChatRepository
     */
    protected $visitRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * VisitChatController constructor.
     *
     * @param VisitChatRepository $visits
     */
    public function __construct( Reservation $reservation,VisitChatRepository $visitRepo)
    {
        $this->reservation = $reservation;
        $this->visitRepo = $visitRepo;
    }
   
}
