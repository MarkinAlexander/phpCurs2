<?php
include_once 'config/db.php';

    class Goods {
        protected $title;
        protected $price;
        protected $imgName;
        protected $description;
        public function __construct($title, $price, $imgName, $description) {
            $this->title = $title;
            $this->price = $price;
            $this->imgName = $imgName;
            $this->description = $description;
        }
        
        public function render(){
            $result = '<div class="goods">';
            $result .= '<h3>'.$this->title.'</h3>';
            $result .= '<div class="goods__img"><img src="/img/'.$this->imgName.'" alt=""></div>';
            $result .= '<p class="goods__desc">'.$this->description.'</p>';
            $result .= '<p class="goods__price">'.$this->price.'</p>';
            $result .= '<a class="goods__btn" href="#">Купить</a></div>';

            return $result;
        }
    }
    
    function getAllGoods(){
      $connect = new PDO(DRIVER . ':host='. SERVER . ';dbname=' . DB, USERNAME, PASSWORD);
      $allGoods = $connect->query("SELECT * FROM goods")->fetchAll();

      $result='';
      foreach ($allGoods as $arr_goods){
          $goods = new Goods($arr_goods['name'],$arr_goods['price'], $arr_goods['img_name'], $arr_goods['desc']);
          $result .= $goods->render();
      }
      return $result;
    }
