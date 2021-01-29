<?php

namespace App\Http\Controllers\Auth;

use 
App\Http\Controllers\Controller, 
App\Providers\RouteServiceProvider, 
Illuminate\Foundation\Auth\AuthenticatesUsers, 
Illuminate\Http\Request,
Illuminate\Validation\ValidationException,
Auth;


class LoginController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('guest:vopd')->except('logout');
    }
    
    // public function showLoginForm()
    // {
    //     return \Hash::make('1234'); 
    //     return view();
    // }


    // $2y$10$JjoB3KiOS/CCEg0iZ.DWmeW00xlk.6zcIyCrysBTKDiNUFdanTI9S

    public function login(Request $request)
    {
        $validation = $this->validate($request, [
                            'login_id' => 'required|string', 
                            'password' => 'required|min:4',
                        ]);

        if(!$validation){
            return back()->withError($validation);
        }
        
        if(Auth::guard('vopd')->attempt(['email_id' => $request->login_id, 'password' => $request->password], $request->filled('remember')) || 
        Auth::guard('vopd')->attempt(['login_id' => $request->login_id, 'password' => $request->password], $request->filled('remember'))){
            return redirect()->intended(route('report.index'));
        }
        else{
            // dd($request->all());
            throw ValidationException::withMessages([
                'login_id' => [trans('auth.failed')],
            ]);
        }
    }
     public function logout (Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect(route('login'));
    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/admin/dashboard';
    
     /**
      * Get the guard to be used during authentication.
      *
      * @return \Illuminate\Contracts\Auth\StatefulGuard
      */
     protected function guard()
     {
         return Auth::guard('vopd');
     }
 
     public function username()
     {
         return 'email_id';
     }
     
     /**
      * Get the password for the user.
      *
      * @return string
      */
     public function getAuthPassword()
     {
         return $this->user_key;
     }
 
     
     
     use AuthenticatesUsers;
    
}
