<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AddReservationRequest;
use App\Http\Requests\Dashboard\ReservationRequest;
use App\Services\UploadService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\Entities\User;
use Modules\Communication\Entities\Communication;
use Modules\Day\Entities\Day;
use Modules\Duration\Entities\Duration;
use Modules\Payment\Entities\Payment;
use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Entities\Traits\User\ReservationMethods;
use Modules\Reservation\Traits\ReservationTrait;

class ReservationController extends Controller
{
    use ReservationTrait,ReservationMethods;

    /**
     * @var Reservation
     */
    protected $reservation;

    /**
     * @param Reservation $reservation
     */
    public function __construct( Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
    /**
     * @return View
     */
    public function index(): View
    {
        $reservations = Reservation::with([ 'doctor', 'user', 'communication'])->latest()->paginate(50); //latest dosen't work whaaaaaaaaay
        return view('dashboard.reservations.index', [
            'reservations' => $reservations
        ]);
    }

    /**
     * @param Reservation $reservation
     * @return View
     */
    public function show(Reservation $reservation):View
    {
        $patient = User::whereId($reservation->user_id)->first();
        $doctor = User::whereId($reservation->doctor_id)->first();
        return view('dashboard.reservations.view', [
            'patient'=> $patient,
            'doctor'=> $doctor,
            'reservation' => $reservation
        ]);
    }

    /**
     * @return View
     */
    public function create():View
    {
        $doctors = User::whereHas('roles',function ($q){
            $q->where('role_id',4);
        })->get();
        $patients = User::whereHas('roles',function ($q){
            $q->where('role_id',3);
        })->get();
        return view('dashboard.reservations.create', [
            'doctors' =>$doctors,
            'patients' =>$patients,
            'days' => Day::where('main_lang','ar')->get(),
            'communications' => Communication::all(),
            'durations' => Duration::all(),
            'payments' => Payment::all(),

        ]);
    }

    /**
     * @param AddReservationRequest $request
     * @return RedirectResponse
     */
    public function store(AddReservationRequest $request):RedirectResponse
    {
        $data = $request->except('finance_attach');
        if ($request->has('finance_attach')){
            $file_path = UploadService::store($request->finance_attach,'reservation_finance');
            $data['finance_attach'] = $file_path;
        }
        $result = $this->adminStoreReservation($data,$this->reservation);
        if ($result !== 'success'){
            return redirect()->back()->with([
                'message' => $result
            ]);
        }
        return redirect()->route('admin.reservations.index')->with(['message'=>trans('admin/dashboard.reservation_added_successfully')]);


    }

    /**
     * @param Reservation $reservation
     * @return View
     */
    public function edit(Reservation $reservation):View
    {
        return view('dashboard.reservations.edit', [
            'reservation' => $reservation,
            'durations' => Duration::all(),
            'days' => Day::where('main_lang','ar')->get(),
            'communications' => Communication::all(),
            'payments' => Payment::all(),

        ]);
    }

    /**
     * @param ReservationRequest $request
     * @param  $id
     * @return RedirectResponse
     */
    public function update(ReservationRequest $request ,$id):RedirectResponse
    {
        $result = $this->adminUpdateReservation($request->validated(),$this->reservation,$id);

        if ($result !== 'success'){
            return redirect()->back()->with([
                'error' => $result
            ]);
        }
        return redirect()->route('admin.reservations.index')->with(['message'=>trans('admin/dashboard.reservation_updated_successfully')]);


    }


}
