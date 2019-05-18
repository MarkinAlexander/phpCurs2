<?php
include_once('m/Goods.php');

class C_Goods extends C_Base {
    public function action_showall() {
        $goods = new Goods('title', 3000, 'img1.jpeg', 'lorem10');
        $allgoods = getAllGoods();
        $this->content = $this->Template('v/v_goods.php', ['allgoods' => $allgoods]);
    }
}
