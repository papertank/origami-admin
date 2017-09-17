<?php

namespace Origami\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Origami\Admin\Http\Controllers\AdminController;

class Sessions extends AdminController
{
    use ThrottlesLogins;

    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $remember = $request->has('remember');

        if (! Auth::guard('admin')->attempt($credentials, $remember)) {
            $this->incrementLoginAttempts($request);
            notice()->error('Invalid login details');
            return admin_redirect('login')->withInput($request->except('password'));
        }

        $this->clearLoginAttempts($request);
        $request->session()->regenerate();
        return admin_redirect('');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return admin_redirect('login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
