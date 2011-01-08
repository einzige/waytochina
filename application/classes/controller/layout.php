<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Layout extends Controller_Haml 
{
    public $template = 'layouts/main';
    public $language = 'ru';

    protected $top_menu;
    protected $lang_menu;

    /* _____________ MESSAGING _____________ */

    protected $messages = array();
    protected $errors   = array();

    public function add_messages($msg) { $this->add_message_type($msg, 'messages'); }
    public function add_errors($msg)   { $this->add_message_type($msg, 'errors'); }

    private function add_message_type($msg, $type)
    {
        if (is_array($msg)) {
            $this->$type = array_merge($msg, $this->$type);
        }
        else {
            array_push($this->$type, $msg);
        }
    }

    public function after()
    {
        Session::instance()->set('messages', $this->messages);
        Session::instance()->set('errors',   $this->errors);

        Haml::set_global('messages', Session::instance()->get_once('messages'));
        Haml::set_global('errors',   Session::instance()->get_once('errors'));

        parent::after();
    }

    /* _______________ END MESSAGING _______________ */

    public function __construct(Request $request)
    {
        $this->language = $request->language();

        i18n::$lang = $this->language . '-' . $this->language; // Fake ISO culture

        Breadcrumbs::add(Breadcrumb::factory()->set_title('«'.__("Мост в Китай").'»')
                                              ->set_url("/"));

        Haml::bind_global('top_menu',  $this->top_menu);
        Haml::bind_global('lang_menu', $this->lang_menu);
        Haml::bind_global('lang',      $this->language);

        $this->top_menu  = Menu::factory('main');
        $this->lang_menu = Menu::factory('lang')->set_current("/set/language/$this->language");

        parent::__construct($request);
    }
}

