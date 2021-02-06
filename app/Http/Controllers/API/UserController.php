<?php

namespace App\Http\Controllers\API;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        // $credentials = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember = true)) {
          // $user = User::where('email',$credentials['email'])->first();
          // dd($user->name);
          // Auth::login($user);
          // Auth::loginUsingId($user->id, $remember = true);
            $request->session()->regenerate();
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Unauthorised';
        }
// dd(Auth::guard());
        // response
        $response = [
            'success' => $success,
            'message' => $message,
            'status' => Auth::check(),

        ];

        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        try {
            // Session::flush();
            Auth::logout();
            $request->session()->flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Sanctum
     */
    public function sanctum()
    {
        // response
        $response = [
            'success' => true,
            'message' => 'test',
        ];
        return response()->json($response);
    }

    /**
     * Books
     */
    public function books()
    {
        // response
        $response = [
            'success' => true,
            'status' => Auth::check(),
        ];
        return response()->json($response);
    }

}
