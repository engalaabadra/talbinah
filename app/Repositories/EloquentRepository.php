<?php

namespace App\Repositories;

use App\Scopes\ActiveScope;
use App\Scopes\LanguageScope;
use GeneralTrait;
class EloquentRepository
{
    use GeneralTrait;


    public function all($total, $model){
        if(page()) return $this->getPaginatesData($total, $model);
        else return $this->getAllData($model);
    }
    


    public function search($model,$words,$col){
        $modelData = $this->search($model,$words,$col);
        return  $modelData;
    }
    
   public  function trash($model,$request){
       if(is_string($this->findAllItemsOnlyTrashed($model))){
           return $this->findAllItemsOnlyTrashed($model);
        }
        $modelData = $this->findAllItemsOnlyTrashed($model)->paginate($request->total);
        return $modelData;
    }


    //methods for store
    public function store($request,$model){
        return $this->action($request,$model);
    }

    public function storeTrans($request,$model,$id){ 
        return $this->action($request,$model,$id);
    }
    
    public function show($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)){
            return 404;
        }
        return $item;
    }

    public function update($request,$id,$model){
        return $this->action($request,$model,$id);
    }

    //methods for restoring
    public function restore($id,$model){
        $item = $this->findItemOnlyTrashed($id,$model);//get this item from trash 
        if(is_string($item)){
            return $item;
        }else{
            if(!empty($item)){//this item not found in trash to restore it
                $item->restore();
            }
            if(authUser()&&authUser()->id){
                $action='Restore an item ';
            }
            return $item;
        }
    }

    public function restoreAll($model){
        $items = $this->findAllItemsOnlyTrashed($model);//get  items  from trash
        if(is_string($items)){
            return $items;
        }else{
            if(!empty($items)){//there is not found any item in trash
                $items = $items->restore();//restore all items from trash into items table
                if(authUser()&&authUser()->id){
                    $action='Restore All';
                }
                return $items;
            }
        }
    }

    //methods for deleting(with softdelete)
    public function destroy($id,$model){
        $forceDelete=0;
        return $this->deleteItem($id,$model,$forceDelete);
    }

    public function forceDeleteItem($id,$model){
        $forceDelete=1;
        return $this->deleteItem($id,$model,$forceDelete);
    }
    //method normal delete(no softdelete)
    public function delete($id,$model){
        return $this->normalDeleteItem($id,$model);
    }
    //method change activate
    public function changeActivate($id,$model){
        return $this->changeActivateItem($id,$model);
    }
    
}

