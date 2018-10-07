<?php

namespace App\Http\Controllers\Slice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteDisabledController extends Controller
{
    public function index()
    {
        return view('errors.site-disabled');
    }
}
