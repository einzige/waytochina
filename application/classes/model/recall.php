<?php defined('SYSPATH') or die('No direct script access.');

class Model_Recall extends ORM {

    protected $_rules = array
    (
        'tel' => array('not_empty' => array())
    );

    protected $_filters = array
    (
        TRUE => array('trim' => array())
    );

    protected $_labels = array
    (
        'tel' => 'Телефон' 
    );
}
