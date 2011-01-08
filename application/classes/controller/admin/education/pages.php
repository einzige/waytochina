<?php defined('SYSPATH') or die('No direct script access.');

// FIXME: almost duplicates business controller  
//
class Controller_Admin_Education_Pages extends Controller_Admin_Pages 
{
    public function before()
    {
        $this->section = ORM::factory('section')->education()
                                                ->lang($this->language)->find();
        parent::before();
    }
}
