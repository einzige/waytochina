<?php defined('SYSPATH') or die('No direct script access.');

class Model_Section_Question extends ORM
{
    protected $_belongs_to = array('section' => array());

    protected $_created_column = array('column' => 'created_at', 'format' => 'Y-m-d H:i:s');

    protected $_rules = array
    (
        'section_id' => array('not_empty' => array()),
        'author'     => array('not_empty' => array()),
        'email'      => array('not_empty' => array()),
    );
    protected $_filters = array
    (
        TRUE => array('trim' => array())
    );

    public function section_name()
    {
        return $this->section->name;
    }
}
