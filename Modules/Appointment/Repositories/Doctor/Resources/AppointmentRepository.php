<?php
namespace Modules\Appointment\Repositories\Doctor\Resources;

use App\Repositories\EloquentRepository;
use Modules\Appointment\Repositories\Doctor\Resources\AppointmentRepositoryInterface;
use Modules\Appointment\Entities\Traits\Doctor\AppointmentMethods;
use GeneralTrait;

class AppointmentRepository extends EloquentRepository implements AppointmentRepositoryInterface
{
    use GeneralTrait,AppointmentMethods;
   public function all($request, $model){
      $status = status();
      if($status){
          if(page()) return $this->getPaginatesDataFilterMethod($request, $model,$status);
          else return $this->getAllDataFilterMethod($model,$status);
      }else{
          if(page()) return $this->getPaginatesDataMethod($request, $model);
          else return $this->getAllDataMethod($model);
      }
  }
    public function store($request,$model){
        return $this->actionMethod($request,$model);
     }
     public function update($request,$model,$id){
        return $this->actionMethod($request,$model,$id);
     }
    public function destroy($id,$model){
        $forceDelete=0;
        return $this->deleteMethod($id,$model,$forceDelete);
    }
    //methods for deleting
    public function changeActivate($id,$model){
        return $this->changeActivateMethod($id,$model);
    }

}
