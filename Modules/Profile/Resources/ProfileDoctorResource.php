<?php

namespace Modules\Profile\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Specialty\Resources\Doctor\SpecialtyResource;
use GeneralTrait;

class ProfileDoctorResource extends JsonResource
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
        if(!authUser() || (!is_string($this->checkIsDoctor(authUser()->id))) && $this->checkIsDoctor(authUser()->id)){
            return [
                'id'            => $this->id,
                'full_name'      => $this->full_name,
                'nick_name'      => $this->nick_name,
                'phone_no'      => $this->phone_no,
                'fcm_token'      => $this->fcm_token,
                'email'      => $this->email,
                'email_verified_at'      => $this->email_verified_at,
                "bio" => $this->profile ? $this->profile->bio :null,
                "original_gender" => $this->profile ? $this->profile->original_gender :null,
                "gender" => $this->profile ? intval($this->profile->gender) :null,
                "birth_date" => $this->profile ? $this->profile->birth_date :null,
                "country" => $this->country,    
                "next_availability" => null,
                // "nextAvailability" => null,
                "nextAvailability" => null,
                'image'      => $this->image,
                "reviews_avg" => avgRatingReview($this->id),
                'price_half_hour' => $this->profile ? $this->profile->price_half_hour:null,
                // 'specialties'      => $this->whenLoaded('specialties', fn () => SpecialtyResource::collection($this->specialties)),
                'specialties'      => $this->specialties ? $this->specialties->map(function($specialty){
                    return SpecialtyResource::make($specialty);
                 }) : null,
                "years_experience" => $this->profile ? $this->profile->years_experience : null,
                "license_number" => $this->profile ? $this->profile->license_number : null,
                "reservations_count" => countReservationsDoctor($this->id),
                'active'      => $this->active,
                'created_at'      => $this->created_at,
        ];
        }else{
            
            return [
                'id'            => $this->id,
                'full_name'      => $this->full_name,
                'nick_name'      => $this->nick_name,
                'phone_no'      => $this->phone_no,
                'fcm_token'      => $this->fcm_token,
                'email'      => $this->email,
                'email_verified_at'      => $this->email_verified_at,
                "bio" => $this->profile ? $this->profile->bio :null,
                "original_gender" => $this->profile ? $this->profile->original_gender :null,
                "gender" => $this->profile ? intval($this->profile->gender) :null,
                "birth_date" => $this->profile ? $this->profile->birth_date :null,
                "country" => $this->profile ? $this->profile->country :null,    
                "next_availability" => null,
                "nextAvailability" => null,
                'image'      => $this->image,
                "reviews_avg" => avgRatingReview($this->id),
                'price_half_hour' => $this->profile ? $this->profile->price_half_hour:null,
                // 'specialties'      => $this->whenLoaded('specialties', fn () => SpecialtyResource::collection($this->specialties)),
                'specialties'      => $this->specialties ? $this->specialties->map(function($specialty){
                    return SpecialtyResource::make($specialty);
                 }) : null,
                "years_experience" => $this->profile ? $this->profile->years_experience : null,
                "license_number" => $this->profile ? $this->profile->license_number : null,
                "reservations_count" => countReservationsDoctor($this->id),
                 'is_fav'=>isFav($this->id),//check if this user make a fav for this doctor
                'active'      => $this->active,
                'created_at'      => $this->created_at,
        ];

        }

    }
}
