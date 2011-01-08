<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Business_Pages extends Controller_Admin_Pages 
{
    public function before()
    {
        $this->section = ORM::factory('section')->business()
                                                ->lang($this->language)->find();
        parent::before();
    }
}
