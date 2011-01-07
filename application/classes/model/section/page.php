<?php defined('SYSPATH') or die('No direct script access.');

class Model_Section_Page extends ORM
{
    protected $_belongs_to = array('section' => array());

    protected $_created_column = array('column' => 'created_at', 'format' => 'Y-m-d H:i:s');

    protected $_rules = array
    (
        'section_id' => array('not_empty' => array()),
        'name'       => array('not_empty' => array())
    );
    protected $_filters = array
    (
        TRUE => array('trim' => array())
    );
    protected $_labels = array
    (
        'title' => 'Заголовок' 
    );

    protected $_sorting = array
    (
        'ord'        => 'ASC',
        'created_at' => 'DESC'
    );

    public function section_name()
    {
        return $this->section->name;
    }

    public function to_array()
    {
        return array('url'   => '/' . $this->section_name() . "/$this->name", 
                     'title' => $this->title);
    }
}
