<?php

namespace App\Http\Controllers\Slice\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function current_user()
    {
        return auth()->user();
    }

    public function edit_current_user(Request $request)
    {
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $password = $request->password;

        $user = auth()->user();

        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        if(!is_null($password)) {
            $user->password = bcrypt($password);
        }
        $user->save();
    }
}
