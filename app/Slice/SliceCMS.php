<?php

namespace App\Slice;

use App\Site;
use App\Theme;

class SliceCMS 
{
    public static function siteId() 
    {
        return session()->get('site_id');
    }

    public static function site() 
    {
        $siteid = self::siteId();
        return Site::find($siteid);
    }

    public static function reloadThemes() 
    {
        $themes_dir = public_path('themes');
        $dirs = scandir($themes_dir);
        $exclude = ['.', '..'];
        $good_dirs = array_diff($dirs, $exclude);
        foreach($good_dirs as $dir) {
            $full_path = "$themes_dir/$dir";
            $theme_config = "$full_path/theme.json";
            if(file_exists($theme_config)) {
                $config_contents = file_get_contents($theme_config);
                $config_object = json_decode($config_contents);
                if(count($config_object)) {
                    $theme_name = $config_object->name;
                    $theme_version = $config_object->version;
                    $theme_author = $config_object->author;

                    $theme_exists = Theme::where('name', $theme_name)->where('version', $theme_version)->first();
                    if(!$theme_exists) {
                        $new_theme = new Theme;
                        $new_theme->name = $theme_name;
                        $new_theme->version = $theme_version;
                        $new_theme->author = $theme_author;
                        $new_theme->uri = $dir;
                        $new_theme->enabled = 1;
                        $new_theme->save();
                    }
                }
            }
        }
    }
}