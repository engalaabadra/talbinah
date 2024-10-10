<?php
namespace Modules\Appointment\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Appointment\Repositories\Admin\Resources\AppointmentRepositoryInterface;
use Modules\Appointment\Entities\Traits\GeneralAppointmentTrait;

class AppointmentRepository extends EloquentRepository implements AppointmentRepositoryInterface
{
    use GeneralAppointmentTrait;

    public function getAllPaginates($model,$request,$lang){
        $result=array_key_exists($lang, config('languages'));
        if($lang&&$result){
            $modelData = $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->with(['doctors'])->paginate($request->total);
        }else{
            return  $modelData = $model->withoutGlobalScope(ActiveScope::class)->with(['doctors'])->paginate($request->total);
        }
        return  $modelData;
    }
    public  function trash($model,$request){
        if(is_string($this->findAllItemsOnlyTrashed($model))){
            return $this->findAllItemsOnlyTrashed($model);
        }
        $modelData = $this->findAllItemsOnlyTrashed($model)->with(['doctors'])->paginate($request->total);
        return $modelData;
    }
 
    public function show($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)){
            return 404;
        }
        return $item->load(['doctors']);
    }

    
}
