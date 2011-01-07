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
        
        $pages = $this->section->pages->find_all();
        $pmenu_items = array();

        foreach($pages as $page)
        {
            $pmenu_items[] = $page->to_array();   
        }

        $this->menu = Menu::factory($section_name);
        $this->menu->insert($pmenu_items, "/$section_name");

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

        $this->view_data['page'] = $page;
        
        $this->menu->set_current('/' . $this->section->name . "/$page->name");
    }

} // End Sections_Base
