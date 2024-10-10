<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Modules\Reservation\Entities\Reservation;

class HomeController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
//        $this->middleware('permission:read-dashboard', ['only' => ['index']]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $reservations = Reservation::with(['appointment', 'doctor', 'user', 'review', 'duration', 'payment', 'communication', 'reasonCancelation', 'reasonRescheduling', 'other', 'files', 'visitChat', 'visitCall', 'prescriptions'])
            ->paginate(20);
        return view('dashboard.index',[
            'reservations'=>$reservations
        ]);
    }
}
