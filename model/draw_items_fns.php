<?
function drawAllGoods(){
    global $connect;
    $res = allCategory();
    if(!$res)
        return "<p>Товары ещё не добавлены.</p>";
    else{
        $result = '';
        while($dataCategory = mysqli_fetch_assoc($res)){
            $categoryId = $dataCategory['category_id'];
            $sql = "SELECT * FROM goods WHERE category_id=$categoryId";
            $resItem = mysqli_query($connect,$sql);
            if($resItem->num_rows === 0)
                //если в данной категории нет товаров то категорию пропускаем
                continue;
            $result .= '<h3 class="title-category">'.$dataCategory['category_title'].'</h3><div class="catalog">';
            while($dataItem = mysqli_fetch_assoc($resItem)){
                $result .= '<div class="item"><div class="title_div"><h4 class="item_title">'.$dataItem['good_title'].'</h4></div>';
                $result .= '<div class="item_img"><img src="/img/min/'.$dataItem['image_name'].'" alt="Фотография '.$dataItem['good_title'].'" class="item_image"></div>';
                $result .= '<p class="desc">'.$dataItem['good_short_desc'].'</p>';
                $result .= '<p class="item_price">'.$dataItem['good_price'].'р</p>';
                if(!itemInCart($dataItem['good_id']))
                    $result .= '<div class="btns"><div class="btn btn_buy" data-idgoods="'.$dataItem['good_id'].'">Купить</div>';
                else
                    $result .= '<div class="btns"><div class="btn btn_buy incart" data-idgoods="'.$dataItem['good_id'].'">В корзине</div>';
                $result .= '<a href="/product/'.$dataCategory['categoru_cpu'].'/'.$dataItem['good_cpu'].'" class="btn btn_desc" target="_blank">Подробнее</a></div></div>';
            }
            $result.='</div>';   
        }
        return $result;
    }

}

function drawGoods(int $countItems = 10){
    global $connect;
    $showNext = false;
    $countLeft = 0;
    $countFirst = 0;
    $sql = "SELECT count(*) as count FROM goods";
    $res = mysqli_query($connect,$sql);
    $count = mysqli_fetch_assoc($res);
    $result = '<h3 class="title-category">Каталог товаров</h3><div class="catalog">';
    if ($count['count'] == 0){
        return "<p>Товаров нет!</p>";
    }
    //если у нас количество записей о товарах больше чем мы хотим выводить за раз
    if($count['count'] > $countItems){
        $showNext = true;
        //переменная countLeft будет хранить количество оставшихся товаров для вывода, это необходимо для JS скрипта
        $countLeft = $count['count'] - $countItems;
        $result .= getDrawGood($countFirst, $countItems);
        $countFirst = $countItems + 1; 
    }
    else{
        $result .= getDrawGood($countFirst, $countItems);
    }
    //если активна переменная showNext значит надо закрыть див каталог и к низу добавить дива добавить кнопку и это вызвать
    if($showNext){
        $more = ($countLeft > $countItems) ? $countItems : $countLeft;
        $result .= '</div><button class="btn btn_next" data-countLeft="'.$countLeft.'" data-countFirst="'.$countFirst.'" data-more="'.$more.'">Ещё '.$more.'</button>';        
    }
    else{
        $result .='</div>';
    }
    return $result;
}

function getDrawGood(int $first, int $countItems){
    global $connect;
    $sql =  "SELECT * from goods JOIN category ON goods.category_id = category.category_id limit $first, $countItems";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0)
        exit();
    else {
        $result = '';
        while($dataItem = mysqli_fetch_assoc($res)){
            $result .= '<div class="item"><div class="title_div"><h4 class="item_title">'.$dataItem['good_title'].'</h4></div>';
            $result .= '<div class="item_img"><img src="/img/min/'.$dataItem['image_name'].'" alt="Фотография '.$dataItem['good_title'].'" class="item_image"></div>';
            $result .= '<p class="desc">'.$dataItem['good_short_desc'].'</p>';
            $result .= '<p class="item_price">'.$dataItem['good_price'].'р</p>';
            if(!itemInCart($dataItem['good_id']))
                $result .= '<div class="btns"><div class="btn btn_buy" data-idgoods="'.$dataItem['good_id'].'">Купить</div>';
            else
                $result .= '<div class="btns"><div class="btn btn_buy incart" data-idgoods="'.$dataItem['good_id'].'">В корзине</div>';
            $result .= '<a href="/product/'.$dataItem['categoru_cpu'].'/'.$dataItem['good_cpu'].'" class="btn btn_desc" target="_blank">Подробнее</a></div></div>';
        }
        return $result;
    }
}