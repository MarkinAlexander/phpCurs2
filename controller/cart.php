<?php

class Cart extends Controller {
    public function cart(){
        echo $this->load_templated_page('cart', 'default', ['title' => 'Корзина', 'h2_title'=>'Корзина покупок']);
    }
}