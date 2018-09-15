<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Login To Slice CMS";
        return view('auth.index', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(auth()->attempt($credentials)) {
            return redirect()->intended('control');
        } else {
            return redirect()->back()->withMessage(['typeid' => 3, 'message'=> 'Invalid email or password. Please try again.', 'timeout'=>0]);
        }
    }

    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect('login')->withMessage(['typeid' => 1, 'message' => 'You have been successfully logged out!', 'timeout' => 5]);
    }
}
