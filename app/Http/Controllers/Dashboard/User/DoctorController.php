<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Entities\User;

class DoctorController extends Controller
{
    public function index()
    {
        return view('dashboard.user.doctor.index', [

            'users' => User::with('country','specialties')->whereHas('roles', function ($q) {
                $q->where('name', 'doctor');
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
        return view('dashboard.user.doctor.view', [

            'doctor' => $user
                ->load(['image','reservationsDoctor','profile','specialties','appointments',
                    'days','reviewsDoctor','wallet'])
        ]);
    }

    public function changeStatus(Request $request, User $user):JsonResponse
    {
        $user->active = $request->input('status');
        $user->save();

        return response()->json(['message' => trans('admin/dashboard.updated_successfully'),'status'=>$user->active]);
    }

}
