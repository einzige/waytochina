<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contacts extends Controller_Section_Base {

    public function before()
    {
        $this->section_name = $this->request->param('section_name');
        parent::before();

        Breadcrumbs::add(Breadcrumb::factory()->set_url("/$this->section_name")
                                              ->set_title($this->section->title));
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Контакты')));

        $this->menu->set_current("/$this->section_name/contacts");

        Haml::set_global('captcha', Captcha::instance('default'));
    }

    public function action_index()
    {
        $this->template->title = __('Контакты') . ' | ' . $this->section->title;
    }

} // End Sections_Base
