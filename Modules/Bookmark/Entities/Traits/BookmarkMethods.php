<?php
namespace Modules\Bookmark\Entities\Traits;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Article\Entities\Article;
trait BookmarkMethods{

      //get data//
      public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->where('user_id',authUser()->id)->with(['article','user'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where('user_id',authUser()->id)->with(['article','user'])->where(['main_lang'=>$lang])->get();
    }

    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();    
        $user=authUser();
        //check if article exist
        $article = Article::where('id',$data['article_id'])->first();
        if(!$article) return 404;
        //check if you make a Bookmark on same article
        $userBookmarkArticle = $model->where(['user_id'=>$user->id,'article_id'=>$data['article_id']])->first();
        if($userBookmarkArticle) return trans('messages.You Added Bookmark on this article before it');
        $data['user_id'] =  $user->id;
        $item = $model->create($data);
        return $item;
    }

    public function normalDeleteItemMethod($model,$request){
        $data=$request->validated();
        $item=$model->where(['article_id'=>$data['article_id'],'user_id'=>authUser()->id])->first();
        if(!$item){
            return 404;
        }
        $item->delete();
    }
}
