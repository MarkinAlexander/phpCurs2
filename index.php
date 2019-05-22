<?php
include_once "Core/Router.php";
include_once "controller/Controller.php";
define ("DOCROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define ("MODELS_PATH", DOCROOT."model/");

include_once MODELS_PATH."config.php";
include_once MODELS_PATH."mysql.php";

include_once AUTH_FNC_PATH."auth_fns.php";
include_once MODELS_PATH."cart/cart_fns.php";
include_once MODELS_PATH."admincontent_fns.php";
include_once MODELS_PATH."draw_items_fns.php";

function redirect($uri){
  header("Location: ".$uri);
}
$router = new Router();
//var_dump($router->uriArr);
if(!empty($router->uriArr['category']) && !empty($router->uriArr['title'])){
    include_once 'controller/product.php';
    $product = new Product();
    $product->openProduct($router->uriArr['category'], $router->uriArr['title']);
}elseif(!$router->uriArr['error']) {

    $route = $router->uriArr['route'];
//var_dump($route);

    include_once 'controller/' . $route['file'] . '.php';
    $file = new $route['file']();
    $action = $route['action'];
    $file->$action();
} else
    var_dump($router);