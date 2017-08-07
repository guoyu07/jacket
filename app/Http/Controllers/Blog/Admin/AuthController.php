<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/16
 * Time: 23:22
 */

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $loginPath  = 'admin/login';
    protected $redirectTo = 'admin/index';
    protected $loginView  = 'blog.admin.login';

    protected function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|email',
            'password' => 'required|string'
        ]);
    }

    public function getLogin()
    {
        return view($this->loginView);
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);


        if ($this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        )) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo);
        }

        $errors = [$this->username() => '账户名或者密码错误'];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->loginPath);
    }
}