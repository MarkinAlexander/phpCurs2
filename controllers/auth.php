<?
function register_urifnc(){
	echo load_templated_page('reg', 'default', ['title' => 'Регистрация', 'h2_title'=>'Регистрация нового пользователя']);
}

function login_urifnc(){
	echo load_templated_page('login', 'default', ['title' => 'Авторизация', 'h2_title'=>'Войти на сайт']);
}
function lk_urifnc(){
	echo load_templated_page('lk', 'default', ['title' => 'Личный кабинет', 'h2_title'=>'Личный кабинет'], ['userName' => getUserName()]);
}

function logout_urifnc(){
	logout();
}