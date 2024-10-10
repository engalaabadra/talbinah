<?php

namespace App\Http\Controllers\WEB\EN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\API\User\DoctorController;
use Modules\Auth\Entities\Role;
use Modules\Article\Entities\Article;
use Modules\Day\Entities\Day;
use GeneralTrait;

class HomeController extends Controller
{
    use GeneralTrait;
    /**
     * @var DoctorController
     */
    protected $doctorController;
    
    /**
     * HomeController constructor.
     *
     * @param BannerResourceController $bannerController
     */
    public function __construct(DoctorController $doctorController)
    {
       $this->doctorController = $doctorController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $role=$this->find(Role::class,'doctor','name');
        $doctors=$role->users()->with(['specialties','image'])->paginate($request->total);
        $days = array();
        $dayAppointment=null;
        $allDays=['Su','Sa','Mo','Tu','We','Th','Fr'];
        $articles=Article::with(['image','articleCategory','keywords'])->paginate($request->total);
        $latestArticles=Article::with(['image','articleCategory','keywords'])->latest()->take(3)->paginate($request->total);
        $maxLengthArticle=150;
        $maxLengthBio=50;
        return view('landing.en.index')->with(compact('doctors','articles','latestArticles','allDays','maxLengthArticle','maxLengthBio'));

    }



}
