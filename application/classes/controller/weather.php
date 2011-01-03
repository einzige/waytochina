<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Weather extends Controller_Layout {

        public $template = 'layouts/weather';

        public function action_index()
        {
            $this->action_russia();
        }

        public function action_russia()
        {
            $this->template->title = 'Погода в городах России';
            $this->template->content = Haml::factory('weather/index', array('cities' => Model_Weather::russia()));
        }

        public function action_china()
        {
            $this->template->content = Haml::factory('weather/index', array('cities' => Model_Weather::china()));
        }

        public function action_russia_widget()
        {
            $this->auto_render = false;
            $forecast = Model_Weather::city('Russia', 'Москва');

            echo Haml::factory('weather/russia_widget', array('forecast' => $forecast));
        }

        public function action_china_widget()
        {
            $this->auto_render = false;
            $forecast = Model_Weather::city('China', 'Пекин');

            echo Haml::factory('weather/china_widget', array('forecast' => $forecast));
        }
} // End Weather
