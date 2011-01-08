<?php defined('SYSPATH') or die('No direct script access.');

class Model_Section extends ORM
{
    protected $_has_many = array('pages' => array());

    protected $_rules = array
    (
        'name' => array('not_empty' => array())
    );
    protected $_filters = array
    (
        TRUE => array('trim' => array())
    );
    protected $_labels = array
    (
        'name' => 'Название'        
    );

    public function business()
    {
        return $this->where('name', '=', 'business');
    }

    public function education()
    {
        return $this->where('name', '=', 'education');
    }

    public function lang($lang)
    {
        return $this->where('lang', '=', "$lang");
    }

    public function to_array()
    {
        return array('url' => "/$this->name", 'title' => $this->title);
    }
}
