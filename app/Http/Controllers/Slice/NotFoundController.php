<?php

namespace App\Http\Controllers\Slice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        return view('errors.site-not-found');
    }
}
