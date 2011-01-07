<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Section_Base extends Controller_Layout {

    public $template = 'layouts/main';

    protected $section;
    protected $pages;

    public    $menu;
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

        $this->menu = Menu::factory($this->section->name)->with_pages($this->section);

        Breadcrumbs::add(Breadcrumb::factory()->set_title($this->section->title));

        Haml::set_global('section',        $this->section);
        Haml::set_global('left_side_menu', $this->menu);
        Haml::set_global('pages',          $this->pages);
    }

    public function action_index()
    {
        $this->menu->set_current("/$this->section_name");
        $this->template->title = $this->section->title;
    }

} // End Sections_Base
