<?php defined('SYSPATH') or die('No direct script access.');

/**
 * [Nested Object Relational Mapping][ref-norm] (NORM) is a method of abstracting database
 *
 */

class NORM extends ORM
{
    protected $_relation_field = 'lang';
    protected $_relation_value = 'ru';
    protected $_relation_model = 'description';

    protected $_relation_class;
    protected $_relation_table;

    public $_relation;

    public function __construct($id = NULL)
    {
        if( ! isset($id[$this->_relation_field]))
        {
            throw new Kohana_Exception("Field <$this->_relation_field> must be set.");
        }
        $this->_relation_value = $id[$this->_relation_field];

        $class_name = substr(get_class($this), 6); 

        $this->_relation_table = strtolower($class_name . '_' . $this->_relation_model);
        $this->_relation_class = 'Model_' . $class_name . '_' . ucfirst($this->_relation_model);

        // make association
        $this->_has_many[$this->_relation_model] = array('model' => $this->_relation_table);

        // clean fake fields
        unset($id[$this->_relation_field]); 

        // ? : because it turns to id = 1 if empty
        parent::__construct(empty($id) ? NULL : $id);

        // init association
        if( ! $this->{$this->_relation_model}) // if association does not exist
        {
            $this->_relation = new $this->_relation_class();
            $this->_relation->{$this->_relation_field} = $this->_relation_value;
        }
        else
        {
            $this->_relation = $this->{$this->_relation_model}->where($this->_relation_field, 
                                                                                '=', 
                                                                      $this->_relation_value)->find();
        }
    }

    public function __get($column)
    {
        if (isset($this->_relation->_table_columns[$column]))
        {
            return $this->_relation->$column;
        }
        parent::__get($column);
    }

    public function __set($column, $value)
    {
        if (isset($this->_relation->_table_columns[$column]))
        {
            $this->_relation->$column = $value;
            return; 
        }
        parent::__set($column, $value);
    }

    public function values($values)
    {
        $this->_relation->values($values); // WARNING: what if we catch id here?

        parent::values($values);
    }

    public function save()
    {
        parent::save();

        $this->_relation->{$this->_object_name . '_id'} = $this->pk();
        $this->_relation->save();
    }

    protected $_filters = array(TRUE => array('trim' => array()));
}
