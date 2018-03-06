<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest");
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
            "username" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6|confirmed",
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
        return User::create([
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
        ]);
    }

    public function checkEmail(Request $request)
    {
        if (DB::table("users")->where("email", "=", $request->email)->exists()) {
            if (isset(Auth::user()->email)) {
                if ($request->email == Auth::user()->email) {
                    return "2";
                } else {
                    return "1";
                }
            } else {
                return "1";
            }
        } else {
            return "2";
        }
    }

    public function checkUsername(Request $request)
    {
        if (DB::table("users")->where("username", "=", $request->username)->exists()) {
            if (isset(Auth::user()->username)) {
                if ($request->username == Auth::user()->username) {
                    return "2";
                } else {
                    return "1";
                }
            } else {
                return "1";
            }
        } else {
            return "2";
        }
    }
}