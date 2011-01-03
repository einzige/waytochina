<?php defined('SYSPATH') or die('No direct script access.');

class Model_Section extends ORM
{
    protected $_has_many = array('section_pages' => array());

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
}
