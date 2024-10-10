<?php

namespace Modules\Geocode\Http\Requests\AddressType;

  
use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Entities\User;
use GeneralTrait;


/**
 * Class DeleteAddressTypeRequest.
 */
class DeleteAddressTypeRequest extends FormRequest
{
    use GeneralTrait;


 
    /**
     * Determine if the AddressType is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Delete AddressType for only superadmin   
        $authorizeRes= $this->authorizeRole(['superadmin']);
        if($authorizeRes==true){
            return true;
        }else{
            return failedAuthorization();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->id=="1"){
            
            return $this->failedAction();
        }else{
            return [
            ];
        }
    }

    
     
    protected function failedAction()
     {
         throw new AuthorizationException(trans('You cannt make this action'));
     }
}
