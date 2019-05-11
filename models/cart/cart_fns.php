<?
function isCart(){
    if(!empty($_SESSION['id_in_cart']))
		return true;
    elseif(isCartId()){
        cartSessionUpdate();
        return true;
    }
    else
         return false;
}
function cartCount(){
    if(isCart()){
        return count($_SESSION['id_in_cart']);
    } else
        return 0;
}

function getPrice($id){
    global $connect;
    $sql = "SELECT good_price FROM goods WHERE good_id='$id'";
    $res = mysqli_query($connect,$sql);
    $data = mysqli_fetch_assoc($res);
    $price = $data['good_price'];
    return $price;

}

function addCart($id){
    global $connect;
    $id =  (int)$id;
    $price = getPrice((int)$id);
    $array = [];
    $cart_id = getCartId();
    $sql = "INSERT INTO carts SET cart_id ='$cart_id', good_id=$id, good_sum=good_count * $price";
    if (!mysqli_query($connect, $sql)) {
        return "<p>Error: " . $sql . "<br>" . mysqli_error($connect)."</p>";
    } else {
        if(!empty($_SESSION['id_in_cart'])){
            $array = $_SESSION['id_in_cart'];
        }
        array_push($array, $id);
        $_SESSION['id_in_cart'] = $array;
    }    
}

function delCart($id){
    global $connect;
    $id =  (int)$id;
    $cart_id = getCartId();
    $sql = "DELETE FROM carts WHERE cart_id = $cart_id AND good_id = $id";
    if (!mysqli_query($connect, $sql)) {
        return "<p>Error: " . $sql . "<br>" . mysqli_error($connect)."</p>";
    } else {
        //создаем массив как буфер
        $array = [];
        //присваиваем ему сессионый массив
        $array = $_SESSION['id_in_cart'];
        //если в корзине больше 1 товара
        if(count($array) > 1){
            //находим под каким индексом у нас товар был в сессионой корзине
            $key = array_search($id, $array);
            //удаляем товар из сессионой корзины
            unset($array[$key]);
            //и переиндксовываем массив возвращая обратно в сессию
            $_SESSION['id_in_cart'] = array_values ($array);
        } 
        else {
            //иначе просто удаляем значения
            unset($_SESSION['id_in_cart']);
        }   
    }
}

function itemInCart($id){
    if(!isCart())
        return false;
    else{
        if(in_array($id, $_SESSION['id_in_cart']))
            return true;
        else
            return false;
    }
}
function getUserID(){
    if(isset($_SESSION['user_id']))
        return $_SESSION['user_id'];
    else
        return null;
}

function setCartID($cart_id){
    setcookie( "cart_id", $cart_id, time()+3600*7*30*24);
    $_SESSION['cart_id'] = $cart_id;
}
function unsetCartID(){
    unset($_COOKIE['cart_id']);
    setcookie( 'cart_id', null, time()-10000000);
    unset($_SESSION['cart_id']);
    unset($_SESSION['id_in_cart']);
}

//действие при оформление заказа
function cartClose($cart_id){
    global $connect;
    $sql = "UPDATE cart SET cart_status = 1 WHERE cart_id=$cart_id";
    unsetCartID();
    if (!mysqli_query($connect, $sql)) {
        return "<p>Error: " . $sql . "<br>" . mysqli_error($connect)."</p>";
    } else {
        return "<p>Заказ отправлен на обработку, ожидайте звонка по указанному телефону!</p>";
    }
}

function genCart($user_id){
    global $connect;
    $sql = "INSERT INTO cart SET user_id ='$user_id'";
    if (!mysqli_query($connect, $sql)) {
        return "<p>Error: " . $sql . "<br>" . mysqli_error($connect)."</p>";
    } else {
        //возвращаем id последнего запроса из базы
        $cart_id  = mysqli_insert_id($connect);
        setCartID($cart_id);
        return $cart_id;
    }
}

function isCartIDinDB($user_id){
    global $connect;
    //проверяем есть ли у нас у пользователя с таким то id корзина со статусом 0 - не закрытая
    $sql = "SELECT cart_id FROM cart WHERE user_id=$user_id AND cart_status=0";
    $res = mysqli_query($connect, $sql);
    //если результата нет то проверяем есть ли  текущая корзина
    if($res->num_rows === 0){
        //если корзина существует то получаем её id и проверяем что она не закрыта
        if(isCartId()){
            $cart_id = getCartId();
            //запрос на корзину которая храниться и при этом не имеет хозяина и не закрыта
            $sql = "SELECT cart_id FROM cart WHERE cart_id=$cart_id AND cart_status=0 AND user_id = null";
            $res2 = mysqli_query($connect, $sql);
            //нас интересует только 1 результат
            if($res2->num_rows === 1){
                //присваиваем в таблицу карт в поле user_id вместо null текущий user_id
                $sql = "UPDATE cart SET user_id=$user_id WHERE cart_id=$cart_id";
                mysqli_query($connect, $sql);
            } else{
                //иначе очищаешь куки и сессию от старой корзины
                unsetCartID();
                //и создаем новую корзину
                genCart($user_id);
            }
            //иначе если корзины нет то надо создать её и установить параметры
        }else{
            genCart($user_id);
        }
    }else{
        unsetCartID();
        $data = mysqli_fetch_assoc($res);
        $cart_id = $data['cart_id'];
        setCartID($cart_id);
    }
}

function isCartId(){
    //проверяем есть ли в сессии id самой корзины
    if(!empty($_SESSION['cart_id']))
        return true;
    //если пусто то проверяем куки на наличие id корзины
    elseif(!empty($_COOKIE['cart_id'])){
        //присваиваем сессии id из куков
        $_SESSION['cart_id'] = (int)$_COOKIE['cart_id'];
        return true;
    }else
    //иначе возвращаем ложь
        return false;  
}

function getCartId(){
    //если функция isCartID возвращает ложь то создаем новую корзину и возвращаем её id
    if(!isCartId())
        return genCart(getUserID());
    else
        return $_SESSION['cart_id'];    
}

function cartSessionUpdate(){
    global $connect;
    $cart_id = getCartId();
    $sql = "SELECT good_id FROM carts WHERE cart_id=$cart_id";
    $res = mysqli_query($connect, $sql);
    $array = [];
    while($data = mysqli_fetch_assoc($res)){
        array_push($array, $data['good_id']);
    }
    $_SESSION['id_in_cart'] = $array;
}

function drawCart(){
    if(!isCart())
        return "<p>В корзине нет товаров!</p>";
    $cart_id =  getCartId();
    global $connect;
    $sql = "SELECT carts.good_id, good_title, good_count, good_sum, good_price FROM carts JOIN goods ON carts.good_id = goods.good_id WHERE cart_id=$cart_id";
    $res = mysqli_query($connect, $sql);
    if($res->num_rows > 0){
        $data = "<table><tr><th>Название</th><th>Количество</th><th>Цена</th><th>Сумма</th><th></th></tr>";
        while($val = mysqli_fetch_assoc($res)){
            $data .= "<tr><td>".$val['good_title'].'</td><td><input type="number" min="1" value="'.$val['good_count']."\"></td><td>".$val['good_price']."</td><td>".$val['good_sum']."</td><td><button class=\"btn btn_del\" data-id=\"".$val['good_id']."\">УДАЛИТЬ</button></td></tr>";
        }
        $data .= "</table><div data-cart_id=\"$cart_id\" class=\"btn btn_order\">Оформить покупку</div>";
        return $data;
    }
}