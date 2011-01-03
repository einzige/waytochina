<?php defined('SYSPATH') or die('No direct script access.');
 
class Request extends Kohana_Request {
	/**
	 * Main request singleton instance. If no URI is provided, the URI will
	 * be automatically detected using PATH_INFO, REQUEST_URI, or PHP_SELF.
	 *
	 * @param   string   URI of the request
	 * @return  Request
	 */
	public static function instance( & $uri = TRUE)
	{
		$instance = parent::instance($uri);

		/* get the lang_abbr from uri segments */
		$segments = explode('/',$instance->uri);
		$lang_abbr = isset($segments[0]) ? $segments[0]:'';

                if($lang_abbr == 'admin') return $instance;
 
		$index_page     = Kohana::$index_file;
		$lang_uri_abbr 	= Kohana::config('appconf.lang_uri_abbr');
		$default_lang 	= Kohana::config('appconf.language_abbr');	
		$lang_ignore	= Kohana::config('appconf.lang_ignore');	
 
 
		/* get current language */
		$cur_lang = $instance->param('lang',$default_lang);
 
		/* check for invalid abbreviation */
		if( ! isset($lang_uri_abbr[$lang_abbr]))
		{		
			/* check for abbreviation to be ignored */
			if ($cur_lang != $lang_ignore) {
				/* check and set the default uri identifier */
				$index_page .= empty($index_page) ? $default_lang : "/$default_lang";
 
			 	/* redirect after inserting language id */
 				header('Location: '.Url::base().$index_page . '/' . $instance->uri);
				die();
			}
 
 
		}
 
 
		return $instance;
	}
}

