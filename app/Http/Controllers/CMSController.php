<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContentSlice;
use App\ContentSliceType;

class CMSController extends Controller
{
    public function site($slug = null)
    {
        $site_id = site()->id;

        if(is_null($slug)) {
            $slug_parts = ['/'];
        } else {
            $slug_parts = explode("/", $slug);
        }

        if(count($slug_parts) == 1 && $slug_parts[0] == "/") {
            // if we're working with the homepage

            if(view()->exists('theme::index')) {
                $slice_title = "Home";

                session()->put('title', $slice_title);

                return view(themeView('index'));
            } else {
                $slice = ContentSlice::where('site_id', $site_id)
                                ->where('uri', '/')
                                ->where('published', 1)
                                ->first();

                if(!$slice) {
                    $message = "404, Page Not Found!";
                    session()->put('title', $message);
                    abort(404, $message);
                }

                $page_type_slug = $slice->slice_type->uri;

                session()->put('title', $slice->title);

                return view(themeView($page_type_slug), compact('slice'));
            }
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
                $news_slice = ContentSliceType::where('date_dependent', 1)->where('uri', $slice_type_uri)->first();

                if($news_slice) {
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

                    return view(themeView($slice_type_uri), compact('slice'));
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

                if($slice_type_exists->date_dependent) {
                    return redirect($slice->full_url);
                }

                session()->put('title', $slice->title);

                return view(themeView($slice_type_uri), compact('slice'));
            }
        }
    }
}
