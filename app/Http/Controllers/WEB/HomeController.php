<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Article\Entities\Article;
use Modules\ArticleCategory\Entities\ArticleCategory;
use Modules\Auth\Entities\User;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {

        $doctors = User::with(['specialties','image'])->whereHas('roles',function ($q){
            $q->where('name','doctor');
        })->get();

        $latestArticles=Article::where('main_lang',session()->get('lang'))
            ->with(['image','articleCategory','keywords'])
            ->latest()->get();

        return view('landing.index',[
            'doctors'=> $doctors,
            'latestArticles'=> $latestArticles,
            'maxLengthArticle'=>150,
            'maxLengthBio'=>50
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function allDoctor(Request $request):View
    {
        $query = User::with(['specialties','image'])->whereHas('roles',function ($q){
            $q->where('name','doctor');
        });
        if ($request->has('search')){
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }
        $doctors = $query->paginate(8);

        return view('pages.dynamic.doctors',[
            'doctors'=>$doctors,
            'maxLengthBio'=>50
        ]);
    }

    /**
     * @param $id
     * @return View
     */
    public function doctorProfile($id):View
    {
        $doctor=User::whereId($id)->with(['specialties','image','appointments','reviewsDoctor','profile'])->first();

        return view('pages.dynamic.single-doctor',[
            'doctor'=>$doctor,
            'maxLengthBio'=>50
        ]);
    }

    /**
     * @return View
     */
    public function allBlog():View
    {
        $articles = Article::where('main_lang',session()->get('lang'))->with(['image','articleCategory','keywords'])->paginate(9);
        $articlesCategories = ArticleCategory::where('main_lang',session()->get('lang'))->get();
        return view('pages.dynamic.blogs')->with(compact('articles','articlesCategories'));
    }

    /**
     * @param $id
     * @return View
     */
    public function viewBlog($id):View
    {  $article = Article::where('id',$id)->with(['image','articleCategory','keywords'])->first();
        return view('pages.dynamic.single-blog')->with(compact('article'));

    }



}
