<?php defined('SYSPATH') or die('No direct script access.');

// FIXME: almost duplicates business controller  
//
class Controller_Admin_Translation_Pages extends Controller_Admin_Pages 
{
    public function before()
    {
        $this->section = ORM::factory('section')->translation()
                                                ->lang($this->language)->find();
        parent::before();
    }
}
