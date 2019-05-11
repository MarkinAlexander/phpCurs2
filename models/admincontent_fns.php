<?
include MODELS_PATH."img/images_fns.php";

function newGoods($title, $short_desc, $full_desc, $price, $category_id){
    $img_name = loadImage();
    global $connect;
    //если строка с именем содержит пробелы, функция лоадимейдж не успешно завершилась.
    if(stripos($img_name, ' ')){
        return $img_name;
    }
    $good_price = (int)$price;
    if($good_price <= 0 )
        return "<p>Цена не может быть отрицательной или нулевой</p>";
    $good_title =  mysqli_real_escape_string($connect, strip_tags($title));
    $good_cpu = translit($good_title);
    
    $sql = "SELECT * FROM goods WHERE  good_cpu = '$good_cpu'";
    $res = mysqli_query($connect,$sql);
    
    if($res->num_rows === 0){
        $good_short_desc =  mysqli_real_escape_string($connect, strip_tags($short_desc));
        $good_full_desc =  mysqli_real_escape_string($connect, strip_tags($full_desc));
        $category_id = (int)$category_id;
        $sql = "INSERT INTO goods SET  category_id=$category_id, good_price = $good_price, good_title='$good_title', good_cpu = '$good_cpu', good_short_desc = '$good_short_desc', good_full_desc = '$good_full_desc', image_name='$img_name';";
        if (!mysqli_query($connect, $sql)) {        
            return "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        return "<p>Товар успешно добавлена</p>";
    }
    else 
        return "<p>Товар с таким именем уже присутствует!</p>";
}

function allCategory(){
    global $connect;
    $sql = "SELECT * FROM category;";
    $res = mysqli_query($connect,$sql);
    //если категории не найдены, значит возвращаем ложь;
    if($res->num_rows === 0){
        return false;
    }
    else
        return $res;
}

function allCategorySelectHTML(){
    $res = allCategory();
    if(!$res)
        return false;
    $result = '';
    while($data = mysqli_fetch_assoc($res)){
        $result.='<option value="'.$data['category_id'].'">'.$data['category_title'].'</option>';   
    }
    return $result;
}

function addCategory($name){
    global $connect;
    $name = mysqli_real_escape_string($connect, strip_tags($name));
    $cpu = translit($name);
    $sql = "SELECT * FROM category WHERE  categoru_cpu = '$cpu'";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0){
        $sql = "INSERT INTO category SET  category_title='$name', categoru_cpu = '$cpu';";
         if (!mysqli_query($connect, $sql)) {        
            return "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        return "<p>Новая категория успешно добавлена</p>";
    }
    return "<p>Категория с таким названием уже существует, измените название</p>";

}

function changeCategory(){

}

function checkNewCategory() {
    if (isset($_POST['new'])) {
        if(empty($_POST['category_name'])){
            echo "<p style=\"color: red\">Укажите название категории</p>";
        }
        else{
            $category_name = $_POST['category_name'];
            echo addCategory($category_name);
        }
    }
}

function redirectNoAdmin(){
    if(!readRole()==ADMIN)
    redirect("/404"); 
}

function drawOrder(array $arr){
    $data = "<table><tr><th>ID корзины</th><th>ID пользователя</th><th>Имя пользователя</th><th>Телефон пользователя</th><th>Адрес пользователя</th></tr>";
    foreach($arr as $val){
        $data.="<tr><td>".$val['cart_id']."</td><td>".$val['user_id']."</td><td>".$val['user_name']."</td><td>".$val['user_phone']."</td><td>".$val['user_addres']."</td></tr>";
    }
    $data.="</table>";
    return $data;
}

function getOrderInWork(){
    //задача сделать запрос к базе и получить там все корзины у которых в статусе 1
    //то есть пользователь её закрыл, но ещё ещё не отработали
    global $connect;
    $sql = "SELECT cart.cart_id, cart.user_id, users.user_name, users_data.user_phone, users_data.user_addres FROM cart LEFT JOIN users ON cart.user_id = users.user_id LEFT JOIN users_data ON cart.user_id = users_data.user_id WHERE cart_status = 1";
    $res = mysqli_query($connect,$sql);
    //если строк нет то выводим что записей нет
    if($res->num_rows === 0){
        return "<p>Не обработанных пользователей нет</p>";
    } 
    else{
        $arr = array();
        while($row = mysqli_fetch_assoc($res)){ // оформим каждую строку результата
            // как ассоциативный массив
            $arr[] = $row; // допишем строку из выборки как новый элемент результирующего массива
        }
        //возвращаем массив
        return drawOrder($arr);
    }
}