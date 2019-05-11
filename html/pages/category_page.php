<?
    redirectNoAdmin();
    checkNewCategory();
 ?>

<form action="/category" method="POST">
    <p>Добавление новой категории</p><br>
    <p>Название категории</p>
    <input type="text" name="category_name">
    <input type="submit" value="Добавить новую категорию" name="new">
</form>

<?if(allCategory()):?>
<form action="/category" method="POST">
    <p>Редактирование существующих категорий</p><br>
    <p>Новое название категории</p>
    <input type="text" name="category_name">
    <p>Редактируемая категория</p>
    <select name="select">
        <?echo allCategorySelectHTML();?>
    </select>
    <input type="submit" value="Изменить категорию" name="change">
</form>
<? else:?>
<p>Категории отсутствуют</p>
<? endif;?>