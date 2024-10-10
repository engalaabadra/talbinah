<?php
namespace App\Traits;
use Modules\Auth\Entities\User;
use App\Providers\RouteServiceProvider;
use App\Scopes\ActiveScope;

trait EloquentTrait{

 //get data -paginates-//
 public function getPaginatesData($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesData($request, $model,getallheaders()['lang']);
    else return $this->paginatesData($request, $model,localLang());
    }
    public function paginatesData($request, $model,$lang=null){
        return $model->where(['main_lang'=>$lang])->paginate($request->total);
    }
    //get data -all- //
    public function getAllData($model){

        if(isset(getallheaders()['lang']))   return $this->allData($model,getallheaders()['lang']);
        else  return $this->allData($model,localLang());
    }
    public function allData($model,$lang=null){
        return $model->where(['main_lang'=>$lang])->get();
    }



    //////////////////////////////////////////////////

    //methods for find
    public function findItemOnlyTrashed($id,$model){
        $itemInTrash=$model->onlyTrashed()->where('id',$id)->first();//item in trash
        if(empty($itemInTrash)){
                return 404;
        }else{
            $item=$model->onlyTrashed()->findOrFail($id);//find this item from trash
            return $item;
        }
    }

    public function findAllItemsOnlyTrashed($model){
        $itemsInTrash=$model->onlyTrashed()->get();//items in trash
        if(count($itemsInTrash)==0){
                return trans('messages.there is not found any items in trash');
        }else{
            $items=$model->onlyTrashed();//get items from trash
            return $items;
        }
    }
    public function find($model,$data,$colName){
        $resultSoftDeletes = isSoftDeletes($model);
        if($resultSoftDeletes){
            if(is_string($model)) $item=$model::withTrashed()->withoutGlobalScope(ActiveScope::class)->where($colName,$data)->first();
            else $item=$model->withTrashed()->withoutGlobalScope(ActiveScope::class)->where($colName,$data)->first();
            if(empty($item)){
                return 404;
            }

        }else{
            if(is_string($model)) $item=$model::withoutGlobalScope(ActiveScope::class)->where($colName,$data)->first();
            else $item=$model->withoutGlobalScope(ActiveScope::class)->where($colName,$data)->first();
            if(empty($item)){
                return 404;
            }
        }
        return $item;
    }
    public function search($model,$words,$col){
        $modelData = $model->where(function ($query) use ($words,$col) {
                        $query->where($col, 'like', '%' . $words . '%');
                    })->get();
        return  $modelData;
    }
    public function findIntroPhone($countryId){
       $country= Country::where('id',$countryId)->first();
       return $country->phone_code;
    }
    //methods actions -store ,store trans, update -
    public function action($request,$model,$id=null){
        $data = $request->validated();
        $item = null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $data['translate_id'] = $id;
                $data['main_lang'] = getallheaders()['lang'];
                $item = $model->create($data);
                //  activity($model,'StoreTranslation');

            }else{//update
                $item = $this->find($model,$id,'id');
                if(is_numeric($item)){
                    return $item;
                }
                $item->update($data);
                //activity($model,'Update');
            }
        }else{//store
            $item = $model->create($data);
            //activity($model,'Store');

        }
        return $item;
    }
    //methods for deleting (with softdelete)
    public function deleteItem($id,$model,$forceDelete){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;

        if($item->deleted_at!==null){
            //this item already deleted permenetly , so now can make force delete for it
            if($forceDelete==0) return trans('messages.this item already deleted permenetly');
            else $this->forceDelete($id,$model);

        }else{// can make normal delete
            $item->delete($item);
            return $item;
        }
    }
    public function forceDeleteItem($id,$model){
        $itemInTrash= $this->findItemOnlyTrashed($id,$model);//find this item from trash
        if(is_string($itemInTrash)){//this item not found in trash items
            return trans('messages.this item not found in trash');
        }else{
            $itemInTrash->forceDelete();
            return $itemInTableitems;
        }
    }

    //method normal delete (no softdeletes)
    public function normalDeleteItem($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        $item->delete($item);

    }
    //method change activate
    public function changeActivateItem($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($item->active == '1') $item->update('active','0');
        elseif($item->active == '0') $item->update('active','1');
        return $item;

    }
}
