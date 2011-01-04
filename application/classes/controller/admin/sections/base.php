<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Sections_Base extends Controller_Admin_Base 
{
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
    }

    public function action_edit()
    {
        if( ! empty($_POST))
        {
            if($this->section->values($_POST['section'])->check())
            {
                $this->section->save();
                $this->add_messages('изменения успешно применены');
            }
            else
                $this->add_errors($section->validate()->errors('section'));
        }

        $this->view_data['section'] = $this->section;
    }

} // End Admin Business
