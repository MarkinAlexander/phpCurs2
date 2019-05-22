<? 
if(!isAuth()) redirect("/404");

if (isset($_POST['send'])) {
    if(empty($_POST['title'])){
        echo "<p>Укажите название товара</p>";
        exit();
    }
    $title = $_POST['title'];

    if(empty($_POST['short'])){
        echo "<p>Укажите краткое описание</p>";
        exit();
    }

    $short = $_POST['short'];

    if(empty($_POST['fulltext'])){
        echo "<p>Укажите краткое описание</p>";
        exit();
    }
    $fulltext = $_POST['fulltext'];

    if(empty($_POST['price'])){
        echo "<p>Укажите краткое описание</p>";
        exit();
    }
    $price = $_POST['price'];
    $select= $_POST['select'];

    echo newGoods($title, $short, $fulltext, $price, $select);
}
if(allCategory()): ?>

<form action="/content" method="POST" enctype="multipart/form-data">
        <p>Название товара</p>
        <input type="text" name="title" required>
        <p>Категория товара</p>
        <select name="select">
            <?echo allCategorySelectHTML();?>   
        </select>
        <p>Краткое описание товара</p>
        <input type="text" name="short" required>
        <p>Полное описание товара</p>
        <textarea name="fulltext" cols="30" rows="10" required></textarea><br>
        <p>Цена товара</p>
        <input type="number" name="price" required value="300"><br>
        <p>Загрузите фото товара</p>
        <input type="file" name="userfile" required><br><br>
        <input type="submit" value="Добавить новый товар" name="send">
</form>
<? else: ?>
<p>Категории отсутствуют необходимо их создать! Для создания обратитесь к администратору!</p>
<? endif; ?>