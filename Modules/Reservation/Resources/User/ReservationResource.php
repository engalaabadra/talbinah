<?php

namespace Modules\Reservation\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Communication\Resources\CommunicationResource;
use Modules\Payment\Resources\PaymentResource;
use Modules\Review\Resources\User\ReviewResource;
use Modules\Duration\Resources\DurationResource;
use Modules\Payment\Traits\PaymentTrait;
use Carbon\Carbon;

class ReservationResource extends JsonResource
{
    use PaymentTrait;
    public $remaining_time=null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        if($this->status=='-1'){
            $url = $this->paymentProcessMethodReservation($this->id,$this->price);
            
            if(isset($url->errors)){
                $url=$url->errors[0]->description; 
            }

            return [
                'id'   => $this->id,
                'url'=>$url,
                'price'=>$this->price,
                'doctor'=> ProfileDoctorResource::make($this->doctor),     
                'is_start'=>$this->is_start,
                'is_end'=>$this->is_end,
                'original_is_start'=>$this->original_is_start,
                'original_is_end'=>$this->original_is_end,
                'visit_chat_time_user'=>$this->visitChat ? $this->visitChat->visit_time_user : null,
                'visit_chat_time_doctor'=>$this->visitChat ? $this->visitChat->visit_time_doctor : null,
                'visit_call_time_user'=>$this->visitCall ? $this->visitCall->visit_time_user : null,
                'visit_call_time_doctor'=>$this->visitCall ? $this->visitCall->visit_time_doctor : null,
                'day'=> $this->appointment ? ($this->appointment->day ? $this->appointment->day->name : null) : null,
                'start_time'=>$this->start_time,
                'end_time'=>$this->end_time,
                'date'=>$this->date,
                'duration'=> $this->duration ? DurationResource::make($this->duration) : null,
                'review'=> $this->review ? $this->review : null,
                'communication'=> $this->communication ? CommunicationResource::make($this->communication) :null,
                'payment'=> $this->payment ? PaymentResource::make($this->payment) :null,
                'problem'=> $this->problem,
                'message'=> $this->message,
                'description'=> $this->description,
                'notes'=> $this->notes,
                'report'=> $this->report,
                'filename'=> $this->filename,
                'link'=> $this->link,
                'full_name'=> $this->full_name,
                'gender'=> $this->gender,
                'original_gender'=> $this->original_gender,
                'age'=> $this->age,
                'problem'=> $this->problem,
                'reason'=>$this->reasonRescheduling ? $this->reasonRescheduling->reason : null,
                'active'=> $this->active,
                'status'=> $this->status,
                'original_active'=> $this->original_active,
                'original_status'=> $this->original_status,
                'created_at'=> $this->created_at,

    
            ];
        }else{
            return [
                'id'   => $this->id,
                'url'=>null,
                'price'=>$this->price,
                'doctor'=> ProfileDoctorResource::make($this->doctor),     
                'is_start'=>$this->is_start,
                'is_end'=>$this->is_end,
                'original_is_start'=>$this->original_is_start,
                'original_is_end'=>$this->original_is_end,
                'visit_chat_time_user'=>$this->visitChat ? $this->visitChat->visit_time_user : null,
                'visit_chat_time_doctor'=>$this->visitChat ? $this->visitChat->visit_time_doctor : null,
                'visit_call_time_user'=>$this->visitCall ? $this->visitCall->visit_time_user : null,
                'visit_call_time_doctor'=>$this->visitCall ? $this->visitCall->visit_time_doctor : null,
                'day'=> $this->appointment ? ($this->appointment->day ? $this->appointment->day->name : null) : null,
                'start_time'=>$this->start_time,
                'end_time'=>$this->end_time,
                'date'=>$this->date,
                'duration'=> $this->duration ? DurationResource::make($this->duration) : null,
                'review'=> $this->review ? $this->review : null,
                'communication'=> $this->communication ? CommunicationResource::make($this->communication) :null,
                'payment'=> $this->payment ? PaymentResource::make($this->payment) :null,
                'problem'=> $this->problem,
                'message'=> $this->message,
                'description'=> $this->description,
                'notes'=> $this->notes,
                'report'=> $this->report,
                'filename'=> $this->filename,
                'link'=> $this->link,
                'full_name'=> $this->full_name,
                'gender'=> $this->gender,
                'age'=> $this->age,
                'problem'=> $this->problem,
                'reason'=>$this->reasonRescheduling ? $this->reasonRescheduling->reason : null,
                'active'=> $this->active,
                'status'=> $this->status,
                'original_active'=> $this->original_active,
                'original_status'=> $this->original_status,
                'created_at'=> $this->created_at,
    
    
            ];
        }
    }
}
