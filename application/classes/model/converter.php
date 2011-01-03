<?php defined('SYSPATH') or die('No direct script access.');

// FIXME: too slow, no cache
//
class Model_Converter
{
    public static function exchange_rates()
    {
        try {
            $cont = file_get_contents("http://www.cbr.ru/scripts/XML_daily.asp");
        } 
        catch(Exception $e) { return false; }
      
        if(preg_match_all ('/<Value(.*?)>(.*?),(.*?)<\/Value>/', $cont, $matches))
        {
            $yuan = $matches[2][15] . '.' . $matches[3][15];
            $euro = $matches[2][10] . '.' . $matches[3][10];
            $usd  = $matches[2][9]  . '.' . $matches[3][9];
      
            return array('yuan' => round($yuan, 2), 
                         'euro' => round($euro, 2),
                         'usd'  => round($usd,  2));
        }
        return false;
    }
}

