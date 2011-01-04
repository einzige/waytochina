<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Layout extends Controller_Haml 
{
    public $template = 'layouts/main';
    public $language = 'ru';

    public function __construct(Request $request)
    {
        $this->language = $request->param('lang');
        i18n::$lang = $this->language . '-' . $this->language; // Fake ISO culture
        parent::__construct($request);
    }
 
    public function after()
    {
        $this->view_data['lang'] = $this->template->lang = $this->language;
        parent::after();
    }
}

