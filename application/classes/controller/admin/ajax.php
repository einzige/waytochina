<?php defined('SYSPATH') or die('No direct script access.');

// Recieves only AJAX calls

class Controller_Admin_Ajax extends Controller {

        public function before()
        {
                $this->auto_render = false;
                parent::before();
        }

        public function action_destroy()
        {
                ORM::factory($_POST['model'])->find($_POST['id'])->delete();
                $this->request->response = 'Запись успешно удалена';
        }

        public function action_order()
        {
            if( ! isset($_POST['row_ids'])) 
            {
                $this->request->response = 'Fatal Error. POST[row_ids] are not set';
                return;
            }

            $i = 0;
            foreach($_POST['row_ids'] as $id)
            {
                if( ! empty($id)) 
                {
                    ORM::factory($_POST['model'], $id)->values(array('ord' => $i++))->save();
                }
            }
            $this->request->response = 'Порядок изменен'; 
        }
}
