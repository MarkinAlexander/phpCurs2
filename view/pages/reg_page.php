<? echo checkRegForm();
?>
<form action="/register" method="POST">
        <p>Ваше имя:</p>
        <input type="text" name="user_name" required>
        <p>Ваш Email:</p>
        <input type="email" name="user_email" required>
        <p>Ваш пароль:</p>
        <input type="password" name="password1" required>
        <p>Повторите пароль:</p>
        <input type="password" name="password2" required><br><br>
        <input type="submit" value="Зарегистрироваться" name="send">
</form>

