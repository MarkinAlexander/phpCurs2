<?php


class Auth extends Controller {
    public function register(){
        echo $this->load_templated_page('reg', 'default', ['title' => 'Регистрация', 'h2_title'=>'Регистрация нового пользователя']);
    }

    function login(){
        echo $this->load_templated_page('login', 'default', ['title' => 'Авторизация', 'h2_title'=>'Войти на сайт']);
    }
    function lk(){
        echo $this->load_templated_page('lk', 'default', ['title' => 'Личный кабинет', 'h2_title'=>'Личный кабинет'], ['userName' => getUserName()]);
    }

    function logout(){
        logout();
    }
}