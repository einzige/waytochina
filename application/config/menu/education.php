<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'view' => 'menu', // the view file
	'current_class' => 'current', // the set_current() method uses this setting to mark the current menu item

	'items' => array
	(
		array
		(
			'url'   => '/education',
			'title' => __('О нас'),
		),
		array
		(
			'url'   => '/education/contacts',
			'title' => __('Контакты'),
		),
	),

);
