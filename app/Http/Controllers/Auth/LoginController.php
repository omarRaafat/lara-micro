<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandleResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
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

    use AuthenticatesUsers , HandleResponse;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function login(Request $request)
    {
          
        if (!Auth::attempt($request->only('email' , 'password'))) {
            throw ValidationException::withMessages([
                'message' => ['These credentials do not match our records.']
            ]);
        }

        $user =  Auth::guard('api')->user();
        $token = Auth::guard('api')->user()->createToken(rand(0,100).'-user-token')->plainTextToken;

        $response = [
            'user' => $user,  // return user info with token
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(){
        
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}
