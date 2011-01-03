<?php defined('SYSPATH') or die('No direct script access.');

// FIXME: too slow, no cache
//
class Helper_Weather
{
    const CITIES_PICTURES_PATH = '/public/images/weather/cities/';
    const STATES_PICTURES_PATH = '/public/images/weather/states/';

    public static function city_image_path($img) { return Helper_Weather::CITIES_PICTURES_PATH . $img; }
    public static function state_image_path($img){ return Helper_Weather::STATES_PICTURES_PATH . $img; }
}

