<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Business extends Controller_Admin_Base {

    public function action_index()
    {
        $this->view_data['section'] = ORM::factory('section')
                                        ->where('name', '=', 'business')->find();
    }

} // End Admin Business