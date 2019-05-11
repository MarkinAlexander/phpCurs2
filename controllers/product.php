<?
include MODELS_PATH."product_fns.php";

function openProduct($category, $title){
    $data = findProduct($category, $title);
    if(!$data)
        redirect("/404");
    else{
        //var_dump($data);
        echo load_templated_page('product', 'default', ['title' => $data['good_title'], 'h2_title'=>$data['good_title']], $data);
    }
}

