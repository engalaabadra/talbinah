<?php
namespace Modules\Article\Entities\Traits;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
//use Modules\Article\Traits\ArticleTrait;
use DateTime;
use DateInterval;

trait ArticleMethods{
    use GeneralTrait;
//get data -paginates-//
public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->with(['image','articleCategory','keywords'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['image','articleCategory','keywords'])->where(['main_lang'=>$lang])->get();
    }

    //actions : store,update , store-trans
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $article=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $article=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $article=$this->find($model,$id,'id');
                if(is_numeric($article)){
                    return $article;
                }
                $article->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$article,$model,'articles-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $article=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$article,$model,'articles-images');
            }  
            //activity($model,'Store');

        }     
        return $article;
    }

    //////////////////////////////////////////////////////////////

    //get newest-data-paginates-//
    public function getNewestArticlesPaginates($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesNewestArticlesMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesNewestArticlesMethod($request, $model);
    }
    public function paginatesNewestArticlesMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->latest()->take(8)->with(['image','articleCategory','keywords'])->paginate($request->total);
    }
    //get newest-data-all- //
    public function getNewestArticlesAll($model){
    if(isset(getallheaders()['lang']))  return $this->allNewestArticlesMethod($model,getallheaders()['lang']);
        else return $this->allNewestArticlesMethod($model);
    }
    public function allNewestArticlesMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['image','articleCategory','keywords'])->where(['main_lang'=>$lang])->latest()->take(8)->get();
    }

    //////////////////////////////////////////////////////////////

    //get trending-data-paginates-//
    public function getTrendingArticlesPaginates($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesTrendingArticlesMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesTrendingArticlesMethod($request, $model);
    }
    public function paginatesTrendingArticlesMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->trending()->where(['main_lang'=>$lang])->with(['image','articleCategory','keywords'])->paginate($request->total);
    }
    //get trending-data-all- //
    public function getTrendingArticlesAll($model){
    if(isset(getallheaders()['lang']))  return $this->allTrendingArticlesMethod($model,getallheaders()['lang']);
        else return $this->allTrendingArticlesMethod($model);
    }
    public function allTrendingArticlesMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['image','articleCategory','keywords'])->where(['main_lang'=>$lang])->trending()->get();
    }

    //search
    public function searchMethod($model,$words,$col){
        $modelData = $model->where(function ($query) use ($words,$col) {
                        $query->where('title', 'like', '%' . $words . '%');
                    })
                    ->orWhere(function ($query) use ($words,$col) {
                        $query->where('description', 'like', '%' . $words . '%');
                    })->with(['image','articleCategory','keywords'])->get();
        return  $modelData;
    }
}
