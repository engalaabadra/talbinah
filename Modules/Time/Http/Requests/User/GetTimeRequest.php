<?php

namespace Modules\Time\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class GetTimeRequest.
 */
class GetTimeRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Time is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    //update Time for only user
        $authorizeRes= $this->authorizeRole(['user']);
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
        
        return [
           'date' => [ 'date','date_format:Y-m-d','after:yesterday'],
            
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }

}
