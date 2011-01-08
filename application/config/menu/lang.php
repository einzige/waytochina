<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'view' => 'menu',             // the view file
	'current_class' => 'active',  // the set_current() method uses this setting to mark the current menu item

	'items' => array
	(
		array
		(
			'url'     => '/set/language/ru',
                        'title'   => __('RU'),
                        'classes' => array('ru')
		),
		array
		(
			'url'   => '/set/language/en',
			'title' => __('EN'),
                        'classes' => array('en')
		),
		array
		(
			'url'   => '/set/language/cn',
			'title' => __('CN'),
                        'classes' => array('cn')
		),
	),

);
