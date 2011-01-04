<?php defined('SYSPATH') or die('No direct access allowed.');

class Form extends Kohana_Form {


    public static function open($action = NULL, array $attributes = NULL)
    {
        if ($action === NULL)
        {
            // Use the current URI
            $action = Request::current()->uri;
        }
        else 
        {
            $action = Request::language() . '/' . $action;
        }

        if ($action === '')
        {
            // Use only the base URI
            $action = Kohana::$base_url;
        }
        elseif (strpos($action, '://') === FALSE)
        {
            // Make the URI absolute
            $action = URL::site($action);
        }

        // Add the form action to the attributes
        $attributes['action'] = $action;

        // Only accept the default character set
        $attributes['accept-charset'] = Kohana::$charset;

        if ( ! isset($attributes['method']))
        {
            // Use POST method
            $attributes['method'] = 'post';
        }

        return '<form'.HTML::attributes($attributes).'>';
    }

} // End Form
