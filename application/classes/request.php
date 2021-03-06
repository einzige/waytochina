<?php defined('SYSPATH') or die('No direct script access.');
 
class Request extends Kohana_Request {

    public $lang;

    public function language()
    {
        return Request::instance()->lang;
    }

    public static function factory($uri)
    {
        if (strpos($uri, '://') === FALSE)
            $uri = Request::instance()->language() . '/' . $uri;

        return new Request($uri);
    }

    public function redirect($url = '', $code = 302)
    {
        if (strpos($url, '://') === FALSE)
            $url = Request::instance()->language() . $url; 

        parent::redirect($url, $code);
    }

    public static function instance( & $uri = TRUE)
    {
        $instance = parent::instance($uri);

        /* get current language */
        $instance->lang = $instance->param('lang');

        // FIXME: bad condition
        //
        if (Request::$method == "POST" OR $instance->controller == 'captcha') 
        {
            return $instance;
        }

        $index_page    = Kohana::$index_file;
        $lang_uri_abbr = Kohana::config('appconf.lang_uri_abbr');
        $default_lang  = Kohana::config('appconf.language_abbr');    
        $lang_ignore   = Kohana::config('appconf.lang_ignore');    

        if( ! $instance->param('lang'))
        {
            if( ! $instance->lang = Session::instance()->get('lang')) 
            {
                $instance->lang = $default_lang;
            }

            $index_page .= empty($index_page) ? $instance->lang : "/$instance->lang";

            header('Location: '.Url::base().$index_page . '/' . $instance->uri);
            die();
        }
        Session::instance()->set('lang', $instance->lang);

        return $instance;
    }
}

