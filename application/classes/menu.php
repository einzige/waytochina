<?php defined('SYSPATH') or die('No direct script access.');
 
class Menu extends Kohana_Menu {
 
	public function __construct($config)
	{
		$this->config = Kohana::config($config);
		$this->view = Haml::factory($this->config['view']);
		$this->menu = array('items' => &$this->config['items']);
	}

        public function with_pages($section)
        {
            $pages = $section->pages->find_all();
            $pmenu_items = array();

            foreach($pages as $page)
                $pmenu_items[] = $page->to_array();   

            $this->insert($pmenu_items, "/$section->name");

            return $this;
        }

        public function insert($items, $after_url = NULL)
        {
            if( ! isset($items[0])) 
            {
                $this->insert_item_at($items, $this->get_position($after_url));
            }
            else
            {
                foreach($items as $item)
                {
                    $this->insert_item_at($item, $this->get_position($after_url));
                }
            }
            return $this;
        }

        public function insert_item_at($item, $position) 
        {
            $item = array($item);
            array_splice($this->menu['items'], $position, 0, $item);

            return $this;
        }

        private function get_position($url)
        {
            if (is_null($url)) 
            {
                return sizeof($this->menu['items']);
            }

            $i = 1;
            foreach($this->menu['items'] as $item) 
            {
                if ($item['url'] == $url) 
                {
                    return $i;
                }
                $i++;
            }

            return sizeof($this->menu['items']);
        }
}

