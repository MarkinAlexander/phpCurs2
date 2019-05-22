<?
include MODELS_PATH."product_fns.php";

class Product extends Controller{
    public function openProduct($category, $title){
        $data = findProduct($category, $title);
        if(!$data)
            redirect("/404");
        else{
            //var_dump($data);
            echo $this->load_templated_page('product', 'default', ['title' => $data['good_title'], 'h2_title'=>$data['good_title']], $data);
        }
    }
}
