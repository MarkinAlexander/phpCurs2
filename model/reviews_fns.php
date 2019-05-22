<?
function addRews($author, $text){
    global $connect;
    $author = mysqli_real_escape_string($connect, strip_tags($author));
    $text = mysqli_real_escape_string($connect, strip_tags($text));
    $sql = "INSERT INTO reviews SET  author_name='$author', reviews_text = '$text';";
    if (!mysqli_query($connect, $sql)) {        
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}

function allRews(){
    global $connect;
    $sql = "SELECT * FROM reviews ORDER BY reviews_date DESC ";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows === 0){
        return '<p>Отзывов ещё нет! Оставьте отзыв и он будет первым!;)</p>';       
    }
    else {
        $result = '<div class="comments">';
        while($data = mysqli_fetch_assoc($res)){
            $result.='<div class="comment"><p class ="username">Имя: <b>'.$data['author_name'].'</b></p>'; 
            $result.= '<p class ="date">Дата: <i>'.$data['reviews_date'].'</i></p>';
            $result.= '<p class ="text">Отзыв: '.$data['reviews_text'].'</p></div>';       
        }
        $result .= '</div>';
        return $result;
    }
}

function checkRewsForm(){
    if (isset($_POST['send'])) {
        if(empty($_POST['text'])){
            echo "<p>Введите текст отзыва!</p>";
            exit();
        }
        $text = $_POST['text'];
        $author = setName();
    
        echo addRews($author, $text);
    }
}