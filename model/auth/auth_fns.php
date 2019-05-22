<?

function isAuth(){
	if(!empty($_SESSION['user_id']))
		return true;
	else return false;
}

function setName(){
    return $_COOKIE['user_name'];
}

function readRole(){
    if(!empty($_SESSION['role']))
        return $_SESSION['role'];
    else
        return GUEST;
}

function regNewUser($email, $password, $password2, $name){
    global $connect;
    $user_email = mysqli_real_escape_string($connect, strip_tags($email));
    $sql = "SELECT * FROM users WHERE user_email='$user_email'";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0){
        //пользователя с таким именем нет и можем регистрировать
        $pass = mysqli_real_escape_string($connect,strip_tags($password));
        $pass2 = mysqli_real_escape_string($connect,strip_tags($password2));
        $user_name = mysqli_real_escape_string($connect,strip_tags($name));
        $solt_pass = md5((string)$pass.SOLT);
        if($pass == $pass2){ //проверяем что пароли одинаковые и если да регистрируем пользователя
            $sql = "INSERT INTO users SET user_email ='$user_email', user_password = '$solt_pass', user_name = '$user_name'";
            if (!mysqli_query($connect, $sql)) {
                return "<p>Error: " . $sql . "<br>" . mysqli_error($connect)."</p>";
            } else {
                setcookie( "user_email", $email, time()+3600*7*30*24);
                setcookie( "user_name", $user_name, time()+3600*7*30*24);
                //возвращаем id последнего запроса из базы
                $user_id = mysqli_insert_id($connect);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = USER;
                $sql = "INSERT INTO users_data SET user_id = $user_id";
                isCartIDinDB($user_id);
                redirect("/");                
            }
        }else {
            return '<p>Пароли отличаются, попробуйте снова</p>';
        }   
    }
    else {
        return '<p>Пользователь с такой почтой существует, попробуйте другое или авторизируйтесь.</p>';
    }
}

function loginUser($email, $password){
    global $connect;
    $user_email = mysqli_real_escape_string($connect, strip_tags($email));
    $pass = mysqli_real_escape_string($connect,strip_tags($password));
    $solt_pass = md5((string)$pass.SOLT);
    $sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$solt_pass'";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0){
        return "<p>Не верное имя пользователя или пароль, убедитесь в правильности ввода.</p>";
    } 
    else{
        $data = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['role'] = $data['user_role'];
        setcookie( "user_email", $email, time()+3600*7*30*24);
        $user_name = $data['user_name'];
        setcookie( "user_name", $user_name, time()+3600*7*30*24);
        isCartIDinDB($data['user_id']);
        redirect("/");
    }
}

function logout(){
    if(isAuth()){
        unset($_SESSION['user_id']);
        unset($_SESSION['cart_id']);
        unset($_SESSION['role']);
        unset($_COOKIE['user_email']);
        setcookie( "user_email", null, time()-1);
        unset($_COOKIE['user_name']);
        setcookie( "user_name", null, time()-1);
        unset($_SESSION['id_in_cart']);
        unset($_COOKIE['cart_id']);
        setcookie( "cart_id", null, time()-1);
        unset($_SESSION['cart_id']);
    }
    redirect("/");
}

function checkLoginForm(){
    if (isset($_POST['send'])) {
        if(empty($_POST['user_email'])){
            return "<p>Укажите Email.</p>";
            //exit();
        }
        $user_email = $_POST['user_email'];
    
        if(empty($_POST['password'])){
            return "<p>Введите пароль</p>";
            //exit();
        }
        $password = $_POST['password'];
    
        return loginUser($user_email, $password);
    }
}

function checkRegForm(){
    if (isset($_POST['send'])) {
        if(empty($_POST['user_email'])){
            return "<p>Укажите Email.</p>";
            //exit();
        }
        $user_email = $_POST['user_email'];
    
        if(empty($_POST['user_name'])){
            return "<p>Укажите Ваше Имя.</p>";
            //exit();
        }
    
        $user_name = $_POST['user_name'];
    
        if(empty($_POST['password1'])||empty($_POST['password1'])){
            return "<p>Введите одинаковые пароли</p>";
            //exit();
        }
    
        $password = $_POST['password1'];
        $password2 = $_POST['password2'];
    
        return regNewUser($user_email, $password, $password2,$user_name);
    }
}