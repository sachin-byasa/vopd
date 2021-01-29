<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    protected function guard()
    {
        return \Auth::guard('arogyasakhi');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ];
    }

    // public function broker()
    // {
    //     return Password::broker('arogyasakhi');
    // }

    protected function credentials(Request $request)
    {
        return ['email_id' => $request->email, 'password' => $request->password, 'password_confirmation' => $request->password_confirmation, 'token' => $request->token ];
    }

    protected function setUserPassword($user, $password)
    {
        $user->user_key = \Hash::make($password);
    }

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
