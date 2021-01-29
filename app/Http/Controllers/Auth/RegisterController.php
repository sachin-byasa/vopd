<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\UserMaster;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'string', 'max:255', 'unique:user_master'],
            'email_id' => ['required', 'string', 'email', 'max:255', 'unique:user_master'],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:user_master'],
            'user_key' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       
        return UserMaster::create([
            'user_name' => $data['user_name'],
            'email_id' => $data['email_id'],
            'login_id' => $data['login_id'],
            'mobile_number' => $data['mobile_number'],
            'user_key' => $data['user_key'],
            'user_type' => $data['user_type'],
            'user_key' => Hash::make($data['user_key']),
            'entry_by' => '1',
            'isactive' => '1',
        ]);
    }
}
