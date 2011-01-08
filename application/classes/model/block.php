<?php
class Model_Block extends ORM {

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
