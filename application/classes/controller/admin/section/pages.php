<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Section_Pages extends Controller_Admin_Base {

    protected $section;

    public function before()
    {
        if( ! isset($this->section))
        {
            $section_id = $this->request->param('section_id');

            if ($section_id) 
                $section = ORM::factory('section')->where('lang', '=', $this->language)
                                                  ->find($section_id);
        }
        
        parent::before();
    }

    public function action_index()
    {
        $this->auto_render = false; // 'cause it renders as partial inda section view, we don't need to render layout
        echo $this->template->content = Haml::factory('admin/section/pages/index', 
                                                       array('section' => $this->section));
    }

    public function action_create()
    {
        $page = new Model_Page;

        if (empty($_POST)) 
        {
            $page->section = $this->section;
        }
        else
        {
            if($page->values($_POST['page'])->check())
            {
                $page->save();
                $this->add_messages('запись успешно добавлена');
            }
            else
                $this->add_errors($page->validate()->errors('page'));
        }

        $this->template->content = Haml::factory('admin/section/pages/edit', array('page' => $page));
    }

    public function action_edit()
    {
        $id = $this->request->param('id');
        $page = ORM::factory('page')->find($id);

        if ( ! empty($_POST))
        {
            if($page->values($_POST['page'])->check())
            {
                $page->save();
                $this->add_messages('изменения успешно применены');
            }
            else
                $this->add_errors($page->validate()->errors('page'));
        }

        $this->template->content = Haml::factory('admin/section/pages/edit', array('page' => $page));
    }

    public function action_destroy()
    {
        if (isset($_POST['id']))
        {
            if (ORM::factory('page')->find($_POST['id'])->delete()) 
            {
                $this->add_messages('запись успешно удалена');
            }
            else
            {
                $this->add_errors('не удалось удалить запись');
            }
        }
        $this->request->redirect(Request::$referrer);
    }

} // End Admin Business
