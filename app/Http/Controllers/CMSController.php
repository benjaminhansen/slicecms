<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContentSlice;

class CMSController extends Controller
{
    public function site($slug = null)
    {
        $site = site();
        $site_id = $site->id;

        if(is_null($slug)) {
            $slug = "/";
        }

        // check if we're working with a news post
        $slug_parts = explode("/", $slug);
        if(count($slug_parts) == 4 && @checkdate($slug_parts[1], $slug_parts[2], $slug_parts[0])) {
            // is a news post
            $year = $slug_parts[0];
            $month = $slug_parts[1];
            $day = $slug_parts[2];
            $uri = $slug_parts[3];

            $slice = ContentSlice::where('site_id', $site_id)
                            ->where('uri', $uri)
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->whereDay('created_at', $day)
                            ->where('content_slice_type_id', 2)
                            ->where('published', 1)
                            ->first();
            if(!$slice) {
                $message = "404, Post Not Found!";
                session()->put('title', $message);
                abort(404, $message);
            }

            session()->put('title', $slice->title);

            return view('post', compact('slice'));
        } else {
            // is a regular page
            $slice = ContentSlice::where('site_id', $site_id)
                            ->where('uri', $slug)
                            ->where('content_slice_type_id', 1)
                            ->where('published', 1)
                            ->first();

            if(!$slice) {
                $message = "404, Page Not Found!";
                session()->put('title', $message);
                abort(404, $message);
            }

            session()->put('title', $slice->title);

            return view('page', compact('slice'));
        }
    }
}
