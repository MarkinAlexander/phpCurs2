<?php

class Admins extends Controller {
    public function admin_panel(){
        echo "Админка";
    }

    function category(){
        echo $this->load_templated_page('category', 'default', ['title' => 'Управление категориями', 'h2_title'=>'Управление категориями товаров']);
    }

    function manager_panel(){
        echo $this->load_templated_page('manager', 'default', ['title' => 'Управление заказами', 'h2_title'=>'Управление заказами']);
    }

    function content_panel(){
        echo $this->load_templated_page('content', 'default', ['title' => 'Добавление товара', 'h2_title'=>'Добавление нового товара!']);
    }
}