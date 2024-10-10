<?php

namespace Modules\Reservation\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Communication\Resources\CommunicationResource;
use Modules\Payment\Resources\PaymentResource;
use Modules\Duration\Resources\DurationResource;
use Carbon\Carbon;
use GeneralTrait;

class ReservationResource extends JsonResource
{
    use GeneralTrait;
    public $remaining_time=null;
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
            'user'=> $this->user->load('image'),     
             'doctor'=> ProfileDoctorResource::make($this->doctor),
            'price'=>$this->price,
            'price_half_hour'=> $this->doctor->profile ? $this->doctor->profile->price_half_hour : null,     
            'birth_date'=> $this->user->profile ? $this->user->profile->birth_date : null,     
            'is_start'=>$this->is_start,
            'is_end'=>$this->is_end,
            'visit_chat_time_user'=>$this->visitChat ? $this->visitChat->visit_time_user : null,
            'visit_chat_time_doctor'=>$this->visitChat ? $this->visitChat->visit_time_doctor : null,
            'visit_call_time_user'=>$this->visitCall ? $this->visitCall->visit_time_user : null,
            'visit_call_time_doctor'=>$this->visitCall ? $this->visitCall->visit_time_doctor : null,
            'duration'=> $this->duration ? DurationResource::make($this->duration) : null,
            'day'=> $this->appointment ? ($this->appointment->day ? $this->appointment->day->name : null) : null,
            'start_time'=> $this->start_time,
            'end_time'=> $this->end_time,            
            'date'=>$this->date,
            'communication'=> $this->communication ? CommunicationResource::make($this->communication) :null,
            'payment'=> $this->payment ? PaymentResource::make($this->payment) :null,
            'full_name'=> $this->full_name,
            'gender'=> $this->gender,
            'original_gender'=> $this->original_gender,
            'problem'=> $this->problem,
            'message'=> $this->message,

            'age'=> $this->age,

            'notes'=> $this->notes,
            'report'=> $this->report,
            'prescriptions'=> $this->prescriptions,
            'filename'=> $this->filename,
            'link'=> $this->link,
            'reason'=>$this->reasonRescheduling ? $this->reasonRescheduling->reason : null,
            'is_start'=>$this->is_start,
            'is_end'=>$this->is_end,
            'original_is_start'=>$this->original_is_start,
            'original_is_end'=>$this->original_is_end,
            'active'=> $this->active,
            'status'=> $this->status,
            'original_active'=> $this->original_active,
            'original_status'=> $this->original_status,
            'created_at'=> $this->created_at,

        ];
    }
    

}
