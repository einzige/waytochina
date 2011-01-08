<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Base extends Controller
{
    public $language = 'ru';

    public function __construct(Request $request)
    {
        $this->language = $request->language();
        i18n::$lang = $this->language . '-' . $this->language; // Fake ISO culture

        parent::__construct($request);
    }
}

