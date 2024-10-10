<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only('logout');
        $this->middleware('guest')->only(['showLoginForm', 'login']);
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {

        return view('dashboard.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (!\auth('web')->attempt($request->only('email', 'password'), true)) {
            throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
        }

        return redirect(route('admin.index'));

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect(route('admin.logout'));
    }
}
