<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Session extends Controller_Layout
{
    public $template = 'layouts/login';

    public function action_index()
    {
        $this->request->redirect('/admin/session/login');
    }

    public function action_login()
    {
        Auth::instance()->logout(); 
 
        $this->template->bind('errors', $errors);
        $this->template->bind('messages', $messages);
 
        if ($_POST)
        {
            Auth::instance()->login($_POST['username'], $_POST['password'], true);

            if ( ! Auth::instance()->logged_in() )
            {
                $errors = array('Ошибка. Вы ввели неверный логин/пароль.');
                return;
            }
 
            Session::instance()->set('messages', array('Вы успешно вошли в панель управления'));
            $this->request->redirect('/admin');
        }
    }
 
    public function action_logout()
    {
        Auth::instance()->logout();
        Cookie::delete('user');
 
        $this->request->redirect('/admin/session/login');
    }

    public function action_init()
    {
        $this->auto_render = false;

        $model = ORM::factory('user');
        $model->values(array(
           'username'         => 'admin',
           'email'            => 'admin@example.com',
           'password'         => 'nimdanimda',
           'password_confirm' => 'nimdanimda',
        ));

        $model->save();

        $model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
        $model->add('roles', ORM::factory('role')->where('name', '=', 'admin')->find());

        echo "Authorization has been successfully initialized.";
    }
}
