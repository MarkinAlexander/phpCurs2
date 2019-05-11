<?
define ("DOCROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define ("MODELS_PATH", DOCROOT."models/");

include_once MODELS_PATH."config.php";
include_once MODELS_PATH."mysql.php";

include_once AUTH_FNC_PATH."auth_fns.php";
include_once MODELS_PATH."template_fns.php";
include_once MODELS_PATH."uri_fns.php";
include_once MODELS_PATH."cart/cart_fns.php";
include_once MODELS_PATH."admincontent_fns.php";
include_once MODELS_PATH."draw_items_fns.php";

$request_string = $_SERVER["REQUEST_URI"];
openURL($request_string);
