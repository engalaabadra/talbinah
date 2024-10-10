<?php

namespace Modules\Reservation\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Reservation\Repositories\Admin\Additional\ReservationRepository;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Reservation\Http\Controllers\API\Admin\ReservationResourceController;
class ReservationController extends ReservationResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Reservation $reservation
     * @param ReservationRepository $reservationRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Reservation $reservation,ReservationRepository $reservationRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->reservation = $reservation;
        $this->reservationRepo = $reservationRepo;
    }

}
