<?php
namespace Modules\Bookmark\Repositories\Resources;

use App\Repositories\EloquentRepository;
use Modules\Bookmark\Repositories\Resources\BookmarkRepositoryInterface;
use Modules\Bookmark\Entities\Traits\BookmarkMethods;

class BookmarkRepository extends EloquentRepository implements BookmarkRepositoryInterface
{
    use BookmarkMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    //method normal delete
    public function delete($id,$model){
        return $this->normalDeleteItemMethod($id,$model);
    }
}
