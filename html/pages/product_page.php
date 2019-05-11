<h3><?=$category_title.' > '.$good_title;?></h3>
<div class="img">
    <img src="/img/full/<?=$image_name;?>" alt="<?=$category_title.'-'.$good_title;?>" title="<?=$good_title.' '.$good_short_desc;?>">
</div>
<div class="desc_and_btn">
    <p class="full_desc"><strong>Описание товара:</strong> <?=$good_full_desc?></p>
    <p class="price"><strong>Цена:</strong> <?=$good_price?> рублей</p>

    <div class="btns">
    <? if(!itemInCart($good_id)): ?>
        <div class="btn btn_buy" data-idgoods="<?=$good_id?>">Купить</div>
    <?else :?>
        <div class="btn btn_buy incart" data-idgoods="<?=$good_id?>">В корзине</div>
    <?endif;?>
    </div>
</div>