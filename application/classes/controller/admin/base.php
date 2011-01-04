<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Layout {

    public $template = 'layouts/admin';

    protected $messages = array();
    protected $errors   = array();

    public function add_messages($msg)
    {
        $this->add_message_type($msg, 'messages');
    }

    public function add_errors($msg)
    {
        $this->add_message_type($msg, 'errors');
    }

    private function add_message_type($msg, $type)
    {
        if(is_array($msg))
            $this->$type = array_merge($msg, $this->$type);
        else
            array_push($this->$type, $msg);
    }

    public function before()
    {
        parent::before();

        if( ! Auth::instance()->logged_in())
            Request::instance()->redirect('/admin/session/login');
    }

    public function after()
    {
        Session::instance()->set('messages', $this->messages);
        Session::instance()->set('errors',   $this->errors);

        $this->template->set('messages', Session::instance()->get_once('messages'));
        $this->template->set('errors',   Session::instance()->get_once('errors'));

        parent::after();
    }

} // End Admin Business
