<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Layout extends Controller_Haml 
{
    public $template = 'layouts/main';
    public $language = 'ru';

    protected $top_menu;
    protected $lang_menu;

    public function __construct(Request $request)
    {
        $this->language = $request->language();

        i18n::$lang = $this->language . '-' . $this->language; // Fake ISO culture

        Breadcrumbs::add(Breadcrumb::factory()->set_title("«Мост в Китай»")
                                              ->set_url("/"));

        Haml::bind_global('top_menu',  $this->top_menu);
        Haml::bind_global('lang_menu', $this->lang_menu);

        $this->top_menu  = Menu::factory('main');
        $this->lang_menu = Menu::factory('lang')->set_current("/set/language/$this->language");

        parent::__construct($request);
    }
 
    public function after()
    {
        $this->view_data['lang'] = $this->template->lang = $this->language;
        parent::after();
    }
}

