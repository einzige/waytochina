<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Layout {

    public $template = 'layouts/admin';

    public function before()
    {
        parent::before();

        if( ! Auth::instance()->logged_in())
            Request::instance()->redirect('/admin/session/login');
    }

} // End Admin Business
