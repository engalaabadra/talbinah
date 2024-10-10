<?php
namespace Modules\Auth\Entities\Traits\Role;
use GeneralTrait;

trait RoleMethods{
    use GeneralTrait;

    /**
    * Method for get Relations  Role.
    *
    * @return object
    */    
    public function getRelationsRole($model,$request,$roleId,$relation){
        $role=$this->find($roleId,$model);
        if(is_string($role)){
            return $role;
        }
        if($relation=='users'){
            return $role->users()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        }elseif($relation=='permissions'){
            return $role->permissions()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        }
        
    }


}
