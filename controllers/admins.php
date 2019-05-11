<?
function admin_panel_urifnc(){
	echo "Админка";
}

function category_urifnc(){
	echo load_templated_page('category', 'default', ['title' => 'Управление категориями', 'h2_title'=>'Управление категориями товаров']);
}

function manager_panel_urifnc(){
	echo load_templated_page('manager', 'default', ['title' => 'Управление заказами', 'h2_title'=>'Управление заказами']);
}

function content_panel_urifnc(){
	echo load_templated_page('content', 'default', ['title' => 'Добавление товара', 'h2_title'=>'Добавление нового товара!']);
}