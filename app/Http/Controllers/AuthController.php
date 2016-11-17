<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequest;

use App\Users;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request, Users $user)
    {
        $credentials = $request->only('username', 'password');
        if(!Auth::attempt($credentials, $request->has('remember')))
        {
            return Response()->json(['Username atau Password yang anda masukan salah'], 401);
        }

        $user = $user->find(Auth::user()->id);

        return Response()->json([
            'intended' => URL::route('dashboard')
        ], 201);


        //redirect()->intended('', 201, )

            //http-equiv="refresh
        //return redirect()->to('dashboard');//redirect()->intended(URL::route('dashboard'));
//        $auth = false;
//        $credentials = $request->only('username', 'password');
////
////        if (Auth::attempt($credentials, $request->has('remember'))) {
////            $auth = true; // Success
////        }
////
////        if ($request->ajax()) {
//////            return response()->json([
//////                'auth' => $auth,
//////                'intended' => URL::previous()
//////            ]);
////
////            return redirect()->route('dashboard');
////        } else {
////            return redirect()->intended(URL::route('dashboard'));
////        }
////        return redirect(URL::route('login'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
