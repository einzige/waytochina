<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Converter extends Controller_Haml {

        public $template = 'layouts/weather';

        public function action_index(){}

        public function action_widget()
        {
            $this->auto_render = false;
            $exchange_rates = Model_Converter::exchange_rates();

            echo Haml::factory('converter/widget', array('exchange_rates' => $exchange_rates));
        }

} // End Weather
