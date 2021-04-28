<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;


class LoginController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function makeLogin(AdminLoginRequest $request)
    {

       $remember_me= $request->has (' remember_me') ? true: '' ;

        if(auth()->guard('admin')->attempt($request->only('email','password'), $remember_me)){
            //Authentication passed...
            return redirect()
                ->intended(route('admin.dashboard'));

        }

        //Authentication failed...
        return $this->loginFailed();

    }

    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with(['error' => __('admin/controller.login-failed')]);
    }

//========================= logout Admin=======================

    public function makeLogout()
    {

        $guard = $this->getGuard();
        $guard->logout();
        return redirect()->route('admin.login');
    }

    public function getGuard()
    {
        return auth('admin');
    }

}
