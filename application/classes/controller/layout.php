<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Layout extends Controller_Haml 
{
    public $template = 'layouts/main';
 
    /**
     * The before() method is called before your controller action.
     * In our template controller we override this method so that we can
     * set up default values. These variables are then available to our
     * controllers if they need to be modified.
     */
    public function before()
    {
        parent::before();
 
        #Set the language with URI
        $lng = Request::instance()->param('lang');
        i18n::$lang = $lng . '-' . $lng;  //Fake the culture as we won't need cultures in our website, only languages.
 
        if ($this->auto_render)
        {
            // Initialize empty values
            $this->template->title   = '';
            $this->template->content = '';
 
            $this->template->styles  = array();
            $this->template->scripts = array();   
        }
    }
 
    /**
     * The after() method is called after your controller action.
     * In our template controller we override this method so that we can
     * make any last minute modifications to the template before anything
     * is rendered.
     */
    public function after()
    {
        /* if ($this->auto_render)
        {
            $styles = array(
                'css/main.css',
            );
 
            $scripts = array(
                'js/jquery.js',
            );
 
            $this->template->styles  = array_merge( $this->template->styles, $styles );
            $this->template->scripts = array_merge( $this->template->scripts, $scripts );
        }*/
        parent::after();
    }
}

