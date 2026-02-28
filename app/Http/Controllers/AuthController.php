<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => "Login"
        ];

        return view('login', $data);
    }

    public function check_login(Request $request)
    {
        $rules = [
            'email'    => 'required',
            'password' => 'required',
        ];

        $messages = [
            'email.required'    => 'Email tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['status' => 'error', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        $email    = $request->input('email');
        $password = $request->input('password');

        // untuk check users
        $checking = [
            'email'    => $email,
            'password' => $password,
            'active'   => 'y'
        ];

        $remember_me  = (!empty($request->remember_me) && $request->remember_me === 'on') ? TRUE : FALSE;

        if (Auth::attempt($checking)) {
            // untuk data users
            $users = Auth::user();

            Auth::login($users, $remember_me);

            // untuk check role
            if ($users->roles) {
                $response = [
                    'status' => 'success',
                    'url'    => url('/admin/dashboard'),
                ];
            } else {
                $response = [
                    'status'  => 'warning',
                    'message' => '<strong>Username</strong> atau <strong>Password</strong> Anda salah!',
                ];
            }
        } else {
            $response = [
                'status'  => 'warning',
                'message' => '<strong>Username</strong> atau <strong>Password</strong> Anda salah!',
            ];
        }

        return Response::json($response);
    }

    public function register()
    {
        $data = [
            'title' => "Register"
        ];

        return view('register', $data);
    }

    public function check_register(Request $request) {}

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->intended('/');
    }
}
