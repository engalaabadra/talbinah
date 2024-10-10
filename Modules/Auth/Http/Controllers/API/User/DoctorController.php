<?php

namespace Modules\Auth\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Repositories\Type\User\Doctor\DoctorRepository;
// use Modules\Auth\Repositories\DoctorRepository;
use GeneralTrait;
use Modules\Auth\Resources\User\DoctorsSpecialtyResource;
use Modules\Profile\Resources\ProfileDoctorResource;
use Modules\Profile\Resources\DoctorResource;
use Modules\Auth\Entities\User;
use Modules\Review\Entities\Review;
use Modules\Favorite\Entities\Favorite;

class DoctorController extends Controller
{
    use GeneralTrait;
    /**
     * @var DcotorRepository
     */
    protected $doctorRepo;
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Review
     */
    protected $review;

    /**
     * @var Favorite
     */
    protected $favorite;
    
    /**
     * DoctorController constructor.
     *
     * @param DoctorRepository $specialties
     */
    public function __construct( User $user,Review $review,Favorite $favorite,DoctorRepository $doctorRepo)
    {
        $this->user = $user;
        $this->review = $review;
        $this->favorite = $favorite;
        $this->doctorRepo = $doctorRepo;
    }
    /**
     * Display a listing of the resource via pagination.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $doctors=$this->doctorRepo->all($request, $this->user);
        if(is_numeric($doctors)) return clientError(4);
        if(page()) $data = getDataResponse(ProfileDoctorResource::collection($doctors));
        else $data = ProfileDoctorResource::collection($doctors);
        return successResponse(0,$data);
    }

    /**
     * Display a listing of the resource via pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTopDoctors(Request $request,$lang=null){
        $topDoctors=$this->doctorRepo->getAllTopDoctors($this->review,$request,$lang);
        if(is_numeric($topDoctors)) return clientError(4);
        if(page()) $data = getDataResponse(ProfileDoctorResource::collection($topDoctors));
        else $data = ProfileDoctorResource::collection($topDoctors);
        return successResponse(0,$data);
    }

}
