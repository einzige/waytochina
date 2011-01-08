<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Recalls extends Controller_Base {

    // recieves only ajax calls 
    //
    public function action_create()
    {
        if (empty($_POST)) $this->request->redirect(Request::$referrer);

        $recall = new Model_Recall;

        if ($recall->values($_POST['recall'])->check())
        {
            $recall->save();
            $message = __('Спасибо. Ваш номер передан администратору.');
            $this->request->response = '{ "class" : "message", "message" : "'.$message.'" }';
        }
        else 
        {
            $message = __('Ошибка. Возможно, Вы неверно ввели телефон.');
            $this->request->response = '{ "class" : "error", "message" : "'.$message.'" }';
        }
    }

} // End Recalls
