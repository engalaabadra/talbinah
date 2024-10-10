<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Modules\Auth\Entities\User;

class UserController extends Controller
{
    public function index()
    {
//        dd(User::with('country')->whereHas('roles', function ($q) {
//            $q->where('name', 'user');
//        })->get());
        return view('dashboard.user.user.index', [

            'users' => User::with('country')->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('deleted_at',null)->latest()->paginate(15)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => trans('admin/dashboard.user_delete_successfully')]);
    }

    public function show(User $user)
    {
        return view('dashboard.user.view', [

            'user' => $user->load('orders')
        ]);
    }

}
