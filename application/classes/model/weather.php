<?php defined('SYSPATH') or die('No direct script access.');

// FIXME: too slow, no cache
//
class Model_Weather
{
    protected static function countries()
    {
        return array(
           'Russia' => array(
               'Москва'          => array( 'index' => 'RSXX0063',  'image' => 'moskva.jpg'),
               'Владивосток'     => array( 'index' => 'RSXX0116',  'image' => 'vladi.jpg'),
               'Волгоград'       => array( 'index' => 'RSXX0117',  'image' => 'volgo.jpg'),
               'Иркутск'         => array( 'index' => 'RSXX0038',  'image' => 'irkutsk.jpg'),
               'Владимир'        => array( 'index' => 'RSXX0187',  'image' => 'vladimir.jpg'),
               'Новосибирск'     => array( 'index' => 'RSXX0077',  'image' => 'novosib.jpg'),
               'Ростов-на-Дону'  => array( 'index' => 'RSXX0090',  'image' => 'rostov3.jpg'),
               'Санкт-Петербург' => array( 'index' => 'RSXX0091',  'image' => 'piter.jpg'),
               'Тула'            => array( 'index' => 'RSXX0109',  'image' => 'tula.jpg'),
               'Улан-Уде'        => array( 'index' => 'RSXX0336',  'image' => 'ulan.jpg'),
               'Якутск'          => array( 'index' => 'RSXX0122',  'image' => 'ykutsk.jpg'),
               'Хабаровск'       => array( 'index' => 'RSXX0044',  'image' => 'habar.jpg')),

           'China' => array(
               'Пекин'      => array( 'index' => 'CHXX0008',     'image' => 'Beijing.jpg'),
               'Далянь'     => array( 'index' => 'CHXX0019',     'image' => 'dalian.jpg'),
               'Чунцин'     => array( 'index' => 'CHXX0017',     'image' => 'Chongqing.jpg'),
               'Шанхай'     => array( 'index' => 'CHXX0116',     'image' => 'Shanghai.jpg'),
               'Чанчунь'    => array( 'index' => 'CHXX0010',     'image' => 'Chanchun.JPG'),
               'Харбин'     => array( 'index' => 'CHXX0046',     'image' => 'harbin.jpg'),
               'Чэнду'      => array( 'index' => 'CHXX0016',     'image' => 'chendu.jpg'),
               'Ханчжоу'    => array( 'index' => 'CHXX0044',     'image' => 'han.jpg'),
               'Ухань'      => array( 'index' => 'CHXX0138',     'image' => 'uhan.jpg'),
               'Шицзячжуан' => array( 'index' => 'CHXX0122',     'image' => 'ShiJiaZhuang.JPG')));
    }

    public static function russia(){ return Model_Weather::country('Russia'); }
    public static function china() { return Model_Weather::country('China');  }

    protected static function country($name)
    {
        $countries = Model_Weather::countries();
        $cities = $countries[$name];

        foreach($cities as $city_name => $data)
            $cities[$city_name] = Model_Weather::city($name, $city_name);

        return $cities;
    }

    public static function city($country_name, $city_name)
    {
        $countries = Model_Weather::countries();
        $states = array(
            'Fair'                     => array('rus' => 'Ясно',                  'img' => 'sun.gif'),
            'Drifting Snow'            => array('rus' => 'Метель',                'img' => 'icon3.gif'),
            'Clear'                    => array('rus' => 'Ясно',                  'img' => 'sun.gif'),
            'Sunny'                    => array('rus' => 'Солнечно',              'img' => 'sun.gif'),
            'Sun'                      => array('rus' => 'Солнечно',              'img' => 'sun.gif'),
            'Light Freezing Rain'      => array('rus' => 'Снег с дождем',         'img' => 'icon3.gif'),
            'Light Snow'               => array('rus' => 'Легкий снег',           'img' => 'icon3.gif'),
            'Light Snow/Windy'         => array('rus' => 'Легкий снег / Ветренно','img' => 'icon3.gif'),
            'Snow'                     => array('rus' => 'Снег',                  'img' => 'icon3.gif'),
            'Mostly Cloudy/Windy'      => array('rus' => 'Сильная<br>облачность', 'img' => 'icon2.gif'),
            'Rain and Snow'            => array('rus' => 'Дождь со снегом',       'img' => 'rain.gif'),
            'Snow Shower'              => array('rus' => 'Снегопад',              'img' => 'icon3.gif'),
            'Scattered Snow Showers'   => array('rus' => 'Небольшой снегопад',    'img' => 'icon3.gif'),
            'Fog'                      => array('rus' => 'Туман',                 'img' => 'icon12.gif'),
            'Mist'                     => array('rus' => 'Туман',                 'img' => 'icon12.gif'),
            'Partly Cloudy'            => array('rus' => 'Переменная облачность', 'img' => 'icon6.gif'),
            'Mostly Cloudy'            => array('rus' => 'Сильная облачность',    'img' => 'icon2.gif'),
            'Mostly Sunny'             => array('rus' => 'Солнечно',              'img' => 'icon6.gif'),
            'Light Drizzle'            => array('rus' => 'Легкий мороз',          'img' => 'icon11.gif'),
            'Light Rain Shower'        => array('rus' => 'Моросящий дождь',       'img' => 'rain.gif'),
            'Rain Shower'              => array('rus' => 'Ливень',                'img' => 'rain.gif'),
            'Drizzle'                  => array('rus' => 'Мороз',                 'img' => 'icon11.gif'),
            'Showers'                  => array('rus' => 'Ливень',                'img' => 'rain.gif'),
            'Rain'                     => array('rus' => 'Дождь',                 'img' => 'rain.gif'),
            'Light Rain'               => array('rus' => 'Легкий дождь',          'img' => 'icon8.gif'),
            'Scattered Showers'        => array('rus' => 'Моросящий дождь',       'img' => 'rain.gif'),
            'Cloudy'                   => array('rus' => 'Облачно',               'img' => 'icon2.gif'),
            'Clouds'                   => array('rus' => 'Облачно',               'img' => 'icon2.gif'),
            'Thunder'                  => array('rus' => 'Гроза',                 'img' => 'icon4.gif'),
            'Light Rain with Thunder'  => array('rus' => 'Легкий дождь с грозой', 'img' => 'icon9.gif'),
            'Thunderstorm'             => array('rus' => 'Сильная гроза',         'img' => 'icon4.gif'),
            'Smoke'                    => array('rus' => 'Дымка',                 'img' => 'icon12.gif'),
            'Haze'                     => array('rus' => 'Дымка',                 'img' => 'icon12.gif'),
            'Scattered T-storms'       => array('rus' => 'Слабая гроза',          'img' => 'icon10.gif'),
            'T-storms'                 => array('rus' => 'Гроза',                 'img' => 'icon5.gif'),
            'Isolated T-storms'        => array('rus' => 'Местами грозы',         'img' => 'icon5.gif'));

        if(isset($countries[$country_name][$city_name]))
        {
            $city = $countries[$country_name][$city_name];
            $city['name'] = $city_name;
        }
        else return false;

        try{
            $rss = file_get_contents("http://xml.weather.yahoo.com/forecastrss?p=".$city['index']."&u=c");
        }catch(Exception $e){
            return false;
        }
        if(preg_match_all('/<yweather:condition[^>]*text="(.*?)"(.*)temp="(.*?)"/', $rss, $matches))
        {
            $city['temperature'] = $matches[3][count($matches[0])-1];
            $state               = $matches[1][count($matches[0])-1];
            
            if(isset($states[$state])){
                if(i18n::$lang == 'ru-ru')
                    $city['state'] = $states[$state]['rus'];
                else
                    $city['state'] = $state;

                $city['pic'] = $states[$state]['img'];
            }

            if( ! isset($city['state']))
            {
                $city['state'] = $state;
                $city['pic']   = 'sun.gif';
            }

            return $city;
        }

        return false;
    }
}

