<?php

namespace App\Http\Controllers\Slice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlController extends Controller
{
    public function index()
    {
        $title = "Welcome to your Slice Dashboard!";
        return view('control.index', compact('title'));
    }
}
