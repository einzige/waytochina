<?php defined('SYSPATH') or die('No direct script access.');
 
class URL extends Kohana_URL {
 
    /**
    * href link generator
    *
    * Returns a href tag after adding the user language in it
    *
    */
    public static function link_to($title, $url, $options=array()){
     
        $option_str = '';
        $site_url = Url::base();
        $lng = Request::instance()->language();
     
        foreach($options as $key => $option){
            $option_str .= "{$key}='{$option}' ";
        }
     
        return "<a href='{$site_url}{$lng}/{$url}' {$option_str}>{$title}</a>";
    }
     
    /**
    * redirect
    *
    * redirect to the given controller/myaction after adding the user language
    *
    */
    public static function redirect($to = ''){
        $site_url = Url::base();
        $lng = Request::instance()->language();
     
        header("Location: {$site_url}{$lng}/{$to}");
        die();
    }
}

