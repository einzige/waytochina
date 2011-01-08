<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'view' => 'menu', // the view file
	'current_class' => 'current', // the set_current() method uses this setting to mark the current menu item

	'items' => array
	(
		array
		(
			'url'   => '/business',
			'title' => __('Бизнес в Китае'),
		),
		array
		(
			'url'   => '/business/contacts',
			'title' => __('Контакты'),
		),
	),

);
