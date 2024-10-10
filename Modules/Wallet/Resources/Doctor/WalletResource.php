<?php

namespace Modules\Wallet\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Resources\Wallet\Doctor\ReservationResource;
use Modules\Profile\Resources\ProfileDoctorResource;
use GeneralTrait;

class WalletResource extends JsonResource
{
    use GeneralTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'user'      => $this->user ? $this->user : null,
            'balance'      => $this->balance,
            'count_movements'=>$this->countMovements($this->id),
            'count_reports'=>count(DB::table('reservations')
                ->select(DB::raw('YEAR(date) year, MONTH(date) month'))
                ->where('doctor_id',$this->user_id)
                ->where('is_end','1')
                ->groupby('year','month')
                ->get())
        ];
    }
}
