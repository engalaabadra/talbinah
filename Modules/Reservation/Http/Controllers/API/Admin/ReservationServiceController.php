<?php
namespace Modules\Reservation\Http\Controllers\API\Admin;
use Modules\Reservation\Http\Controllers\API\Admin\ReservationController;
use Modules\Reservation\Services\Admin\ReservationService;
class ReservationServiceController extends ReservationController
{
    /**
     * @var ReservationService
     */
    protected $reservationService;
      
    
    /**
     * ReservationServiceController constructor.
     *
     */
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    //to calling method service for Reservation : 1. using object from it 2. register in app service container and using it
    
 }