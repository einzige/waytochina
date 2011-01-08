<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Questions extends Controller_Section_Base {

    protected $question;

    public function before()
    {
        $this->section_name = $this->request->param('section_name');
        parent::before();

        Breadcrumbs::add(Breadcrumb::factory()->set_url("/$this->section_name")
                                              ->set_title($this->section->title));
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Вопросы')));

        $this->menu->set_current("/$this->section_name/contacts");

        Haml::bind_global('question', $this->question);
    }

    public function action_create()
    {
        if (empty($_POST)) $this->request->redirect(Request::$referrer);

        $this->question = new Model_Section_Question();

        if ($this->question->values($_POST['question'])->check() && Captcha::valid($_POST['captcha']))
        {
            $this->question->save();
            $this->request->redirect("/$this->section_name/questions/success");
        }
        else { 
            $this->add_errors(__('Вы неверно ввели символы с изображения'));
        }

        Haml::set_global('captcha', Captcha::instance('default'));
        $this->template->content = Haml::factory('questions/new');
    }

    public function action_success(){}

} // End Controller_Questions
