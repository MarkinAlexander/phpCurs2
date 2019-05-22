<? echo checkLoginForm();
?>
<form action="/login" method="POST">
        <p>Ваш Email:</p>
        <input type="email" name="user_email" required><br>
        <p>Ваш пароль:</p>
        <input type="password" name="password" required><br>
        <input type="submit" value="Войти" name="send">
</form>
