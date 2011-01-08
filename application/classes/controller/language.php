<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Language extends Controller {

    public function action_set()
    {
        $lang = $this->request->param('another_lang');
        $http = explode('http://', Request::$referrer);

        $this->request->redirect(url::site() . "$lang/" . implode('/', array_slice(preg_split('/\//', $http[1]), 2)));
    }
} // End Controller_Language
