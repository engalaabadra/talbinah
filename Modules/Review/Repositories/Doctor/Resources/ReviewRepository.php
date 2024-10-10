<?php
namespace Modules\Review\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\Review\Repositories\Doctor\Resources\ReviewRepositoryInterface;
use Modules\Review\Entities\Traits\Doctor\ReviewMethods;

class ReviewRepository extends EloquentRepository implements ReviewRepositoryInterface
{
    use ReviewMethods;

    public function getAllPaginates($model,$request,$lang){
        $allHeaders=getallheaders();
        $result=array_key_exists($lang, config('languages'));
        if($lang&&$result){
            if(isset($allHeaders['rating'])) $modelData = $model->where('doctor_id',authUser()->id)->where('rating',$allHeaders['rating'])->with(['user'])->where(['main_lang'=>$lang])->paginate($request->total);
            else $modelData = $model->where('doctor_id',authUser()->id)->where(['main_lang'=>$lang])->with(['user'])->paginate($request->total);
        }else{
            if(isset($allHeaders['rating'])) $modelData = $model->where('doctor_id',authUser()->id)->where('rating',$allHeaders['rating'])->with(['user'])->paginate($request->total);
            else $modelData = $model->where('doctor_id',authUser()->id)->with(['user','avg(rating)'])->paginate($request->total);
        }
        return  $modelData;
    }
 
}
