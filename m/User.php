<?php
	include_once 'config/db.php';

	class User {
		
		public $user_id, $user_login, $user_name, $user_password;

		public function __construct () {
		}

		public function pass ($name, $password) {
			return strrev(md5($name)) . md5($password);
		}

		public function connecting () {
			return new PDO(DRIVER . ':host='. SERVER . ';dbname=' . DB, USERNAME, PASSWORD);
		}

		public function get ($id) {
			$connect = $this->connecting();
			return $connect->query("SELECT * FROM users WHERE id = '" . $id . "'")->fetch();
		}

		public function newR ($name, $login, $password) {
			$connect = $this->connecting();
			$user = $connect->query("SELECT * FROM users WHERE login = '" . $login . "'")->fetch();
			if (!$user) {
				$connect->exec("INSERT INTO users VALUES (null, '" . $name . "', '" . $login . "', '" . $this->pass($name, $password) . "')");
				return true;
			} else {
				return false;
			}
		}

		public function login ($login, $password) {
			$connect = $this->connecting();
			$user = $connect->query("SELECT * FROM users WHERE login = '" . $login . "'")->fetch();
			if ($user) {
				if ($user['password'] == $this->pass($user['name'], strip_tags($password))) {
    				$_SESSION['user_id'] = $user['id'];
    				return 'Добро пожаловать в систему, ' . $user['name'] . '!';
				} else {
					return 'Пароль не верный!';
				}
			} else {
				return 'Пользователь с таким логином не зарегистрирован!';
			}
		}

		public function logout () {
			if (isset($_SESSION["user_id"])) {
				$_SESSION["user_id"]=null;
				session_destroy();
				return true;
			} 
			return false;
			
		}
	}