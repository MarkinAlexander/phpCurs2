<?
function load_simple_page($page, $datasimple=[]){
	extract($datasimple);
	ob_start();
	include PAGE_PATH.$page."_page.php";
	return ob_get_clean();
}

function load_templated_page($page, $template, $data=[], $datasimple=[]){
	$data["content"] = load_simple_page($page, $datasimple);
	extract($data);
	ob_start();
	include TEMPLATE_PATH.$template.".php";
	return ob_get_clean();
}