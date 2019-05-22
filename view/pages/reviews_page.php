<?include MODELS_PATH."reviews_fns.php";
checkRewsForm();
echo allRews();

if(isAuth()): ?>
<form action="/reviews" method="POST">
            <p>Текст отзыва:</p>
            <textarea name="text" cols="30" rows="10" required></textarea><br>
            <input type="submit" value="Отправить"name="send">
</form>
<? else: ?>
    <p><a href="/login">Авторизируйтесь</a> или <a href="/register">Зарегистрируйтесь</a> что-бы оставить отзыв</p>
<? endif; ?>
