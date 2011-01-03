<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Haml {

    public $template = 'layouts/admin';
    
    public function before()
    {
        parent::before();
        $this->session = Session::instance();

        if( ! Auth::instance()->logged_in())
            Request::instance()->redirect(Path::login_admin());
    }

} // End Admin Business
