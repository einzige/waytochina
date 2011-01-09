<?php defined('SYSPATH') or die('No direct script access.');

class Model_University_Description extends ORM
{
    protected $_belongs_to = array('university' => array());

    protected $_rules = array
    (
        'university_id' => array('not_empty' => array()),
        'lang'          => array('not_empty' => array())
    );
    protected $_filters = array
    (
        TRUE => array('trim' => array())
    );

    public function lang($lang)
    {
         return $this->where('lang', '=', $lang);
    }
}
