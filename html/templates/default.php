<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vollkorn+SC" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
			  crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="/css/style.css">
    <title><?=$title?> - Лапша-Суши-Пицца</title>
</head>

<body>
    <div class="wrapper">
        <nav class="navigation">
            <ul class="menu">
                <li><a href="/">Главная</a></li>
                <li><a href="/menu">Меню</a></li>
                <li><a href="/cart">Корзина</a></li>
				<? if(!isAuth()): ?>
                <li><a href="/register">Регистрация</a></li>
                <li><a href="/login">Авторизация</a></li>
				<? else: ?> 
                <? if(readRole()==ADMIN||readRole()==MANAGER) echo '<li><a href="/manager">Заказы</a></li>';?>
                <? if(readRole()==ADMIN||readRole()==CMANAGER) echo'<li><a href="/content">Добавление товаров</a></li>';?>
                <? if(readRole()==ADMIN) echo'<li><a href="/admin">Админка</a></li><li><a href="/category">Категории</a></li>';?>
				<? endif; ?>
                <li><a href="/about">О нас</a></li>
                <li><a href="/delivery_and_pay">Доставка и оплата</a></li>
                <li><a href="/reviews">Отзывы</a></li>
				<? if(isAuth()): ?>
                <li class="logout" ><a href="/logout">Выйти</a></li>
				<? endif; ?>
            </ul>
            <? if(isAuth()):?><p>Добро пожаловать, <?=$_COOKIE["user_name"];?>!</p><? endif;?>
        </nav>
        <div class="cart">
        <?if(isCart()):?>
            Количество товаров в корзине: <?= cartCount()?>.
        <?else:?>
            В корзине нет товаров.
        <?endif;?>
        </div>
        <h1 class="header">Лапша-суши-пицца</h1>
        <h2 class="title"><?=$h2_title?></h2>
        <main>
            <?=$content?>

        </main>
        <footer>&copy;2019 Лапша-Суши-Пицца</footer>
    </div>
    <script src="/js/script.js"></script>
</body>

</html>
