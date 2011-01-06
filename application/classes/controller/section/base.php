<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Section_Base extends Controller_Layout {

    public $template = 'layouts/main';

    protected $section;
    public    $section_name;

    public function before()
    {
        parent::before();

        if( ! isset($this->section_name))
            throw new Kohana_Exception('Section name must not be empty');

        $this->section = ORM::factory('section')
                                ->where('name', '=', $this->section_name)
                                ->lang($this->language)->find();

        if( ! $this->section->id)
        {
            $name = $this->section->name;
            throw new Kohana_Exception("Section with the given name <$name> does not exists");
        }

        Haml::set_global('section', $this->section);
    }

    public function action_index()
    {
    }

} // End Sections_Base
