<?php

namespace App\Http\Controllers\Slice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "My Profile";
        return view('control.profile.index', compact('title'));
    }
}
