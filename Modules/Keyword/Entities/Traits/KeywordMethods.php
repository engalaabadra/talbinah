<?php
namespace Modules\Keyword\Entities\Traits;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Duration\Entities\Duration;
use DateTime;
use DateInterval;

trait KeywordMethods{
    use GeneralTrait;
//get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
    if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->with(['image'])->where(['main_lang'=>$lang])->get();
    }

    //actions : store,update , store-trans
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $keyword=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $keyword=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $keyword=$this->find($model,$id,'id');
                if(is_numeric($keyword)){
                    return $keyword;
                }
                $keyword->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$keyword,$model,'keywords-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $keyword=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$keyword,$model,'keywords-images');
            }  
            //activity($model,'Store');

        }     
        return $keyword;
    }

    //////////////////////////////////////////////////////////////

    //get newest-data-paginates-//
    public function getNewestKeywordsPaginates($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesNewestKeywordsMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesNewestKeywordsMethod($request, $model);
    }
    public function paginatesNewestKeywordsMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->where(['main_lang'=>$lang])->latest()->take(8)->with(['image'])->paginate($request->total);
    }
    //get newest-data-all- //
    public function getNewestKeywordsAll($model){
    if(isset(getallheaders()['lang']))  return $this->allNewestKeywordsMethod($model,getallheaders()['lang']);
        else return $this->allNewestKeywordsMethod($model);
    }
    public function allNewestKeywordsMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->with(['image'])->where(['main_lang'=>$lang])->latest()->take(8)->get();
    }

    //////////////////////////////////////////////////////////////

    //get trending-data-paginates-//
    public function getTrendingKeywordsPaginates($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesTrendingKeywordsMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesTrendingKeywordsMethod($request, $model);
    }
    public function paginatesTrendingKeywordsMethod($request, $model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->trending()->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get trending-data-all- //
    public function getTrendingKeywordsAll($model){
    if(isset(getallheaders()['lang']))  return $this->allTrendingKeywordsMethod($model,getallheaders()['lang']);
        else return $this->allTrendingKeywordsMethod($model);
    }
    public function allTrendingKeywordsMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        return $model->with(['image'])->where(['main_lang'=>$lang])->trending()->get();
    }

    //search
    public function searchMethod($model,$words,$col){
        $modelData = $model->where(function ($query) use ($words,$col) {
                        $query->where('title', 'like', '%' . $words . '%');
                    })
                    ->orWhere(function ($query) use ($words,$col) {
                        $query->where('description', 'like', '%' . $words . '%');
                    })->get();
        return  $modelData;
    }
}
