<?php

use App\Slice\SliceCMS;

function site() {
    return SliceCMS::{__FUNCTION__}();
}

function reloadThemes() {
    return SliceCMS::{__FUNCTION__}();
}

function themes_path($uri = null) {
    return public_path("themes/$uri");
}

function theme_uri($uri = null) {
    $current_theme = site()->assigned_theme;
    $theme_uri = $current_theme->uri;

    return url("themes/$theme_uri/$uri");
}

function theme_path($uri = null) {
    $current_theme = site()->assigned_theme;
    $theme_uri = $current_theme->uri;

    return themes_path("$theme_uri/$uri");
}

function stylesheet_uri() {
    $uri = theme_path('style.css');
    if(file_exists($uri)) {
        return theme_uri('style.css');
    } else {
        return "#style.css-not-found";
    }
}

function title($separator = "|", $include_tagline = true) {
    $title = session()->get('title');
    $site = site();
    $site_name = $site->name;
    $site_tagline = $site->tagline;

    if($include_tagline) {
        $final_title = "$title $separator $site_name $separator $site_tagline";
    } else {
        $final_title = "$title $separator $site_name";
    }

    return $final_title;
}

function message() {
    if(session()->has('message')) {
        $session_message = session()->get('message');
        $typeid = $session_message['typeid'];
        $message = $session_message['message'];
        $timeout = $session_message['timeout'];
        $timeout_ms = $timeout * 1000;

        switch($typeid) {
            case 1:
                // success
                $class = "success";
                break;
            case 2:
                // warning
                $class = "warning";
                break;
            case 3:
                // danger
                $class = "danger";
                break;
            default:
                // info
                $class = "info";
        }

        if($timeout == 0) {
            $html_timeout = "slicecms-alert";
        } else {
            $html_timeout = "slicecms-alert slicecms-alert-timeout-$timeout_ms";
        }

        $html = "<div class='alert alert-$class $html_timeout'>$message</div>";

        return $html;
    }
}

function nav($type) {
    if(view()->exists("slice.nav.$type")) {
        return "slice.nav.$type";
    } else if(view()->exists("theme::extra-navs.$type")) {
        return "theme::extra-navs.$type";
    } else {
        throw new Exception("Nav type [$type] could not be found!");
    }
}

function str_slug_underscore($slug) {
    return str_replace("-", "_", str_slug($slug));
}

function themeView($view) {
    $full_path = "theme::$view";
    if(view()->exists($full_path)) {
        return $full_path;
    } else {
        throw new Exception("View [$full_path] not found!");
    }
}
