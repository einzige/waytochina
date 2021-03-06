<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contacts extends Controller_Layout {

    public $template = 'layouts/main';

    protected $section;

    public $menu;
    public $section_name;

    public function before()
    {
        parent::before();

        $this->section_name = $this->request->param('section_name');

        $this->section = ORM::factory('section')
                                ->where('name', '=', $this->section_name)
                                ->lang($this->language)->find();

        if( ! $this->section->id)
        {
            throw new Kohana_Exception("Section with the given name <$this->section_name> does not exists");
        }

        $this->menu = Menu::factory($this->section_name)->with_pages($this->section);
        $this->menu->set_current("/$this->section_name/contacts");

        $this->top_menu->set_current("/$this->section_name");

        Breadcrumbs::add(Breadcrumb::factory()->set_url("/$this->section_name")
                                              ->set_title($this->section->title));
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Контакты')));

        Haml::set_global('section',        $this->section);
        Haml::set_global('left_side_menu', $this->menu);
        Haml::set_global('question', ORM::factory('section_question'));
        Haml::set_global('captcha', Captcha::instance('default'));
    }

    public function action_index()
    {
        $this->template->title = __('Контакты') . ' | ' . $this->section->title;
    }

} // End Sections_Base
