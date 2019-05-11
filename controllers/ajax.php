<?
function add_item_urifnc(){
    if (isset($_POST['id'])) {
        if(isset($_POST['action'])){
            if($_POST['action']=='add'){
                addCart((int)$_POST['id']);
                echo "Добавлен в корзину товар с id ".$_POST['id'];
            }
        }
    }

	
}

function del_item_urifnc(){
    if (isset($_POST['id'])) {
        if(isset($_POST['action'])){
            if($_POST['action']=='del'){
                delCart((int)$_POST['id']);
                echo "Удален с корзины товар с id ".$_POST['id'];
            }
        }
    }    
}

function draw_cart_urifnc(){
    echo drawCart();
}

function cart_close_urifnc(){
    if(isset($_POST['cart_id'])){
        $cart_id_POST = (int)$_POST['cart_id'];
        $cart_id_SESSION = getCartId();
        if($cart_id_POST == $cart_id_SESSION){
            echo cartClose($cart_id_SESSION);
        }
    }
}

function drawMoreItems_urifnc(){
    if(isset($_POST['action'])&& isset($_POST['first']) && isset($_POST['more'])){
        if($_POST['action'] == 'more'){
            $first = (int)$_POST['first'];
            $more =  (int)$_POST['more'];
            echo getDrawGood($first, $more);
        }
    }
}