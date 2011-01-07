<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Section_Pages extends Controller_Layout {

    public $template = 'layouts/main';
    public $menu;

    protected $section;

    public function before()
    {
        $section_name = $this->request->param('section_name');

        $this->section = ORM::factory('section')
                                ->where('name', '=', $section_name)
                                ->lang($this->language)->find();

        if( ! $this->section->id)
        {
            throw new Kohana_Exception("Section with the given name <$section_name> does not exists");
        }
        
        $this->menu = Menu::factory($section_name)->with_pages($this->section);

        Breadcrumbs::add(Breadcrumb::factory()->set_title($this->section->title)
                                              ->set_url("/$section_name"));

        Haml::set_global('section',        $this->section);
        Haml::set_global('left_side_menu', $this->menu);

        parent::before();
    }

    public function action_show()
    {
        // FIXME: in different sections we can have pages with the same name!
        //
        $page = $this->section->pages->where('name', '=', $this->request->param('page_name'))
                                     ->find();
        
        $page_url = '/' . $this->section->name . "/$page->name";

        $this->menu->set_current($page_url);
        $this->top_menu->set_current('/' . $this->section->name);

        Breadcrumbs::add(Breadcrumb::factory()->set_title($page->title ? $page->title : 'Страница не переведена'));

        $this->template->title = $page->title;

        $this->view_data['page'] = $page;
    }

} // End Sections_Base
