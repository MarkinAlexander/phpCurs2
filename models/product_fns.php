<? function findProduct($category, $title){
    global $connect;
    $category = mysqli_real_escape_string($connect,strip_tags($category));
    $title = mysqli_real_escape_string($connect,strip_tags($title));
    $sql = "SELECT * FROM goods JOIN category ON goods.category_id = category.category_id WHERE category.categoru_cpu='$category' AND goods.good_cpu='$title';";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0){
        return false;
    }
    else{
        $data = mysqli_fetch_assoc($res);
        return $data;
    }
}