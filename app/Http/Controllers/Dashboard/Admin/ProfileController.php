<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\ChangePasswordRequest;
use App\Http\Requests\dashboard\ProfileRequest;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class   ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.admin.profile.mainInfo', [
            'title' => __('admin/dashboard.profile'),
        ]);
    }

    /**
     * @param ProfileRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function update(ProfileRequest $request): JsonResponse|RedirectResponse
    {
        Auth::user()?->update($request->except(['_token','photo']));
        if ($request->hasFile('photo')) {
            $request->validate(['photo' => 'sometimes|image|mimes:png,jpg,jpeg,gif']);
            if (auth()->user()->photo) {
                UploadService::delete(auth()->user()->photo); //delete from storage
            }

           $image_path = UploadService::store($request->photo,'profile'); //Add Image

            authUser()->photo = $image_path;
            authUser()?->save();
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => __('admin/dashboard.profile_update_successfully')
        ]);
    }

    /**
     * @return View
     */
    public function changePassword(): View
    {
        return view('dashboard.admin.profile.changePassword', ['title' => __('admin/dashboard.change_password')]);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(ChangePasswordRequest $request): RedirectResponse
    {
        if (!Hash::check($request->new_password, auth()->user()->password)) {
            $status = 'error';
            $message = __('admin/dashboard.incorrect_password');

        } else {
            $status = 'success';
            $message = __('admin/dashboard.password_saved_successfully');

            Auth::user()?->update(['password' => bcrypt($request->new_password)]);
        }

        return redirect()->back()->with(['status' => $status, 'message' => $message]);
    }
}
