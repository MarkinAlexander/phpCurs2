<?

class main extends Controller {
    public function index(){
        echo $this->load_templated_page('index', 'default', ['title' => 'Главная страница', 'h2_title'=>'Самое популярное!']);
    }
    public function error404(){
        header("HTTP/1.0 404 Not Found");
        echo $this-> load_templated_page('error404', 'default', ['title' => 'Страница не найдена', 'h2_title'=>'Ой! Что-то пошло не так!']);
    }

    function about(){
        echo $this-> load_templated_page('about', 'default', ['title' => 'О нас', 'h2_title'=>'Наши ценности и традиции!']);
    }

    function delivery(){
        echo $this-> load_templated_page('delivery', 'default', ['title' => 'Доставка и оплата', 'h2_title'=>'Доставка и оплата заказа']);
    }

    function rews(){
        echo $this-> load_templated_page('reviews', 'default', ['title' => 'Отзывы', 'h2_title'=>'Отзывы о нас']);
    }

    function menu(){
        var_dump(load_simple_page('index'));
    }
}