<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContentSlice;
use App\ContentSliceType;

class CMSController extends Controller
{
    public function site($slug = null)
    {
        $site = site();
        $site_id = $site->id;

        if(is_null($slug)) {
            $slug_parts = ['/'];
        } else {
            $slug_parts = explode("/", $slug);
        }

        if(count($slug_parts) == 1 && $slug_parts[0] == "/") {
            // if we're working with the homepage
            $slice = ContentSlice::where('site_id', $site_id)
                            ->where('uri', '/')
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
        } else {
            // if we're not working with the homepage
            $slice_type_uri = $slug_parts[0];
            $slice_type_exists = ContentSliceType::where('uri', $slice_type_uri)->first();
            if(!$slice_type_exists) {
                $message = "404, Page Not Found!";
                session()->put('title', $message);
                abort(404, $message);
            }

            if(count($slug_parts) == 5 && @checkdate($slug_parts[2], $slug_parts[3], $slug_parts[1])) {
                // if it's a news post
                $news_slice = ContentSliceType::where('slice_function', 'news')->first();

                if($slice_type_uri == $news_slice->uri) {
                    $year = $slug_parts[1];
                    $month = $slug_parts[2];
                    $day = $slug_parts[3];
                    $uri = $slug_parts[4];

                    $slice = ContentSlice::where('site_id', $site_id)
                                    ->where('uri', $uri)
                                    ->whereYear('created_at', $year)
                                    ->whereMonth('created_at', $month)
                                    ->whereDay('created_at', $day)
                                    ->where('content_slice_type_id', $news_slice->id)
                                    ->where('published', 1)
                                    ->first();
                    if(!$slice) {
                        $message = "404, Page Not Found!";
                        session()->put('title', $message);
                        abort(404, $message);
                    }

                    session()->put('title', $slice->title);

                    return view('post', compact('slice'));
                } else {
                    $message = "404, Page Not Found!";
                    session()->put('title', $message);
                    abort(404, $message);
                }
            } else {
                unset($slug_parts[0]);
                $slug_parts = implode("/", $slug_parts);

                // is a regular page
                $slice = ContentSlice::where('site_id', $site_id)
                                ->where('uri', $slug_parts)
                                ->where('content_slice_type_id', $slice_type_exists->id)
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
}
