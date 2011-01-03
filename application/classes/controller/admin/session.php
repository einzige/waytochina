<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Session extends Controller_Haml
{
    public $template = 'layouts/login';

    public function action_login()
    {
        Auth::instance()->logout(); 
 
        $this->template->title = 'Вход в систему управления сайтом';
        $this->template->content = View::factory('admin/login')
            ->bind('user',   $user)
            ->bind('errors', $errors);
 
        if ($_POST)
        {
            Auth::instance()->login($_POST['username'], $_POST['password'], true);

            if ( ! Auth::instance()->logged_in() )
            {
                $errors = array('Ошибка. Вы ввели неверный логин/пароль.');
                return;
            }
 
            $this->request->redirect('/admin');
        }
    }
 
    public function action_logout()
    {
        Auth::instance()->logout();
        Cookie::delete('user');
 
        $this->request->redirect('/admin/login');
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
