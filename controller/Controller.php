<?php
class Controller{
    protected function load_simple_page($page, $datasimple=[]){
        extract($datasimple);
        ob_start();
        include 'view/pages/'.$page."_page.php";
        return ob_get_clean();
    }

    protected function load_templated_page($page, $template, $data=[], $datasimple=[]){
        $data["content"] = $this->load_simple_page($page, $datasimple);
        extract($data);
        ob_start();
        include 'view/templates/'.$template.".php";
        return ob_get_clean();
    }
}