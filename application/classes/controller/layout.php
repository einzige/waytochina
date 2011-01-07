<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Layout extends Controller_Haml 
{
    public $template = 'layouts/main';
    public $language = 'ru';

    public function __construct(Request $request)
    {
        $this->language = $request->language();

        i18n::$lang = $this->language . '-' . $this->language; // Fake ISO culture

        Breadcrumbs::add(Breadcrumb::factory()->set_title("«Мост в Китай»")
                                              ->set_url("/"));

        parent::__construct($request);
    }
 
    public function after()
    {
        $this->view_data['lang'] = $this->template->lang = $this->language;
        parent::after();
    }
}

