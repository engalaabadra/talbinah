<?php

namespace Modules\Profile\Http\Controllers\API\Doctor;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Profile\Entities\Profile;
use Modules\Profile\Http\Requests\Doctor\UpdateProfileRequest;
use Modules\Profile\Repositories\Doctor\ProfileRepository;
use  Modules\Profile\Http\Requests\UpdatePasswordRequest;
use GeneralTrait;
use Modules\Profile\Resources\DoctorResource;
use Modules\Profile\Resources\UserResource;
class ProfileController extends Controller
{
    use GeneralTrait;

     /**
     * @var ProfileRepository
     */
    protected $profileRepo;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Profile
     */
    protected $profile;

    /**
     * ProfileController constructor.
     *
     * @param ProfileRepository $Profile
     */
    public function __construct(  ProfileRepository $profileRepo,Profile $profile, User $user)
    {

        $this->profileRepo = $profileRepo;
        $this->profile = $profile;
        $this->user = $user;
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($doctorId=null)
    {
        $data=  $this->profileRepo->show($this->user,$doctorId);
        if(is_numeric($data)) return  clientError(4);
        if(is_string($data)) return  clientError(0,$data);
        $rolesUser = $this->rolesUserByName($data);
        if(in_array('user',$rolesUser)) return successResponse(0,new UserResource($data->load(['image'])));//will show user page not doctor page
        return successResponse(0,new DoctorResource($data->load(['image','profile','reviewsDoctor.user'])));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProfileRequest $request)
    {
        $userId=authUser()->id;
        $user=$this->find($this->user,$userId,'id');
        $userUpdated=  $this->profileRepo->update($request,$this->profile,$user);
        return successResponse(2,new DoctorResource($userUpdated->load(['image','profile','reviewsDoctor.user'])));
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $userId=authUser()->id;
        $userUpdatedPassword=  $this->profileRepo->updatePassword($request,$this->user);
        if(is_string($userUpdatedPassword)){
            return clientError(0,$userUpdatedPassword);
        }
        return successResponse(2,new DoctorResource($userUpdatedPassword->load(['image','profile','reviewsDoctor.user'])));

    }


}
