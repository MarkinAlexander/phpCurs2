<?php
class Router{
    //переменная для хранения адреса страниц
    private $uri;
    public $uriArr = [];
    public function __construct(){
        $this->uri = $this->getUri();
        $this->uriArr = $this->check();
    }

    private function getUri(){
        return $_SERVER['REQUEST_URI'];
    }


    private function check(){
        $error = false;
        $errorText = '';
        $route = '';
        $category = '';
        $title = '';
        $url = $this->uri;
        $routes = include "Route.php";
        $url_arr = explode("/", $url);
        //удаляем из массива пустые значения, и переиндыксовываем его
        $request_arr = array_values(array_diff($url_arr, array('')));
        //проверяем есть ли наша ссылка в массиве роутов
        if (!empty($routes[$url]))
            //var_dump($routes[$url]);
            $route = $routes[$url];
        //проверяем что у нас есть в массиве product и размер его три элемента
        elseif($request_arr[0]=='product' && count($request_arr)==3){
            $category = $request_arr[1];
            $title = $request_arr[2];
            //include CTRL_PATH."product.php";
            //openProduct($category, $title);
            //echo "Категория $category<br>Название $title";
            //var_dump($request_arr);
        }else {
            //var_dump($request_arr);
            //$this->redirect("/404");
            $error = true;
            $errorText = '404';
        }
        $array = compact("error", "errorText", "route", "category", "title");
        //var_dump(compact($error, $errorText, $routesUrl, $category, $title));
        return $array;
    }

}