<?
  include_once 'config.php';
  function translit($string) {
      $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'ъ' => '', 'ь' => '', 'э' => 'eh', 'ю' => 'yu', 'я'=>'ya');

      return str_replace(' ', '_', strtr(mb_strtolower(trim($string)), $translit));
   }

   function changeImage($h, $w, $src, $newsrc, $type) {
    $newimg = imagecreatetruecolor($h, $w);
    switch ($type) {
      case 'jpeg':
        $img = imagecreatefromjpeg($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagejpeg($newimg, $newsrc);
        break;
      case 'png':
        $img = imagecreatefrompng($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagepng($newimg, $newsrc);
        break;
      case 'gif':
        $img = imagecreatefromgif($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagegif($newimg, $newsrc);
        break;
    }
   }

  if (isset($_POST['send'])) {
    if ($_FILES['userfile']['error']) {
      $message = 'Ошибка загрузки файла!';
    } elseif ($_FILES['userfile']['size'] > 1000000) {
      $message = 'Файл слишком большой';
    } elseif (
        $_FILES['userfile']['type'] == 'image/jpeg'||
        $_FILES['userfile']['type'] == 'image/png' ||
        $_FILES['userfile']['type'] == 'image/gif'
      ) {
          $translitName = translit($_FILES['userfile']['name']);
          if (copy($_FILES['userfile']['tmp_name'], PHOTO.$translitName)) {
            $path = PHOTO_SMALL.$translitName;
            $type = explode('/', $_FILES['userfile']['type'])[1];
            changeImage(150, 150, $_FILES['userfile']['tmp_name'], $path, $type);
            $sql = "INSERT INTO img (img_name) VALUES(\"".$translitName."\")";
              if (mysqli_query($connect, $sql)) {
                  $message = "New record created successfully";
              } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($connect);
              }

              
          }
          else {$message = 'Ошибка загрузки файла!';}
      }
      else {
        $message = 'Не правильный тип файла!';
    }
  }

    $sql = "select * from img ORDER BY like_count DESC ";
    $res = mysqli_query($connect,$sql);
    $form = '<div class="images">';
    while($data = mysqli_fetch_assoc($res)){
        $form.='<div class="s_img"><a href="image.php?photo=';
        $form.= $data['id_img'].'"><img src="'.PHOTO_SMALL.$data['img_name'].'"></img></a>';
        $form.='<p>Просмотров :'.$data['like_count'].'</p></div>';
    }
    $form.='</div>';
   


