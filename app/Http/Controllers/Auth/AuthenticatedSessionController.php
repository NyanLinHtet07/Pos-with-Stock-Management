<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\AuthenticatesUsers;




class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ( Auth::user() -> role_id == '1')
        {
            return redirect()->intended(RouteServiceProvider::MAIN);

        }

        if ( Auth::user() -> role_id == '2')

        {
            return redirect()->intended(RouteServiceProvider::BRANCH);
        }

        else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        //return redirect()->intended(RouteServiceProvider::MAIN);

        // if( Auth::user() -> role_id == '1')
        // {
        //     return redirect()->route('dashboard');
        // }
        // elseif( Auth::user() -> role_id == '2')
        // {
        //     return redirect()->route('branch');
        // }
        // else {
        //     return redirect('/');
        // }
       
    }

    // protected function authenticated (Request $request, $user)
    // {
    //     if($user->role_id == '1')
    //     {
    //         return redirect('/dashboard');
    //     }
    //     if($user -> role_id == '2')
    //     {
    //         return redirect('/main/branch');
    //     }
    //     else {
    //         return redirect('/');
    //     }
    // }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
