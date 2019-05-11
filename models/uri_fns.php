<?
function redirect($url){
	header("Location: ".$url);
}
/*
$url_arr = explode("/", $request_string);
$request_arr = array_diff($url_arr, array(''));
if (!empty($request_arr))
var_dump ($request_arr); */
const _ROUTES = [
	"/"  					=> ["file" => "main", 			"function" => "index"],
	"/404"  				=> ["file" => "main", 			"function" => "error404"],
	"/about"  				=> ["file" => "main", 			"function" => "about"],
	"/delivery_and_pay"		=> ["file" => "main", 			"function" => "delivery"],
	"/reviews"		        => ["file" => "main", 			"function" => "rews"],
	"/menu"		            => ["file" => "main", 			"function" => "menu"],
	"/cart"  				=> ["file" => "cart", 			"function" => "cart"],
	"/admin"  				=> ["file" => "admins", 		"function" => "admin_panel"],
	"/manager"  			=> ["file" => "admins", 		"function" => "manager_panel"],
	"/content"  			=> ["file" => "admins", 		"function" => "content_panel"],
	"/category"  			=> ["file" => "admins", 		"function" => "category"],
	"/register"  			=> ["file" => "auth", 			"function" => "register"],
	"/login"  				=> ["file" => "auth", 			"function" => "login"],
	"/logout"  				=> ["file" => "auth", 			"function" => "logout"],
	"/ajax/additem"			=> ["file" => "ajax", 			"function" => "add_item"],
	"/ajax/delitem"			=> ["file" => "ajax", 			"function" => "del_item"],
	"/ajax/drawcart"		=> ["file" => "ajax", 			"function" => "draw_cart"],
	"/ajax/closecart"		=> ["file" => "ajax", 			"function" => "cart_close"],
	"/ajax/drawmoreitems"	=> ["file" => "ajax", 			"function" => "drawMoreItems"],
];

function openRoute($route) {
	//var_dump($route);
	include CTRL_PATH.$route["file"].".php";
	call_user_func($route["function"]."_urifnc");
}


function openURL($url){
	//из строки $url получаем массив
	$url_arr = explode("/", $url);
	//удаляем из массива пустые значения, и переиндыксовываем его
	$request_arr = array_values(array_diff($url_arr, array('')));
	if (!empty(_ROUTES[$url]))
		openRoute(_ROUTES[$url]);
		//проверяем что у нас есть в массиве product и размер его три элемента
	elseif($request_arr[0]=='product' && count($request_arr)==3){
		$category = $request_arr[1];
		$title = $request_arr[2];
		include CTRL_PATH."product.php";
		openProduct($category, $title);
		//var_dump($request_arr);
	}else
		//var_dump($request_arr);
		redirect("/404");
}