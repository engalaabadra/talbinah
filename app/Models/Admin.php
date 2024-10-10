<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;

class Admin extends Authenticatable
{
    use HasFactory;


    protected $fillable = ['name','email','phone','password','photo'];

    /**
     * @param $item
     * @return string|null
     */
    public function getPhotoAttribute($item):string|null
    {

        return $item ? Storage::url($item) : null;
    }
}
