<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'view' => 'menu',             // the view file
	'current_class' => 'current', // the set_current() method uses this setting to mark the current menu item

	'items' => array
	(
		array
		(
			'url'     => '/business',
                        'title'   => __('Бизнес в Китае'),
                        'classes' => array('first')
		),
		array
		(
			'url'   => '/education',
			'title' => __('Образование в Китае'),
		),
		array
		(
			'url'   => '/translation',
			'title' => __('Услуги перевода'),
		),
		array
		(
			'url'   => '/questions',
			'title' => __('Ваш вопрос о Китае'),
		),
		array
		(
			'url'     => '/blog',
                        'title'   => __('Блог о Китае'),
                        'classes' => array('last')
		),
	),

);
