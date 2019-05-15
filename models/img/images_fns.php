<?
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

 function loadImage(){
    if (isset($_POST['send'])) {
        if ($_FILES['userfile']['error']) {
          return  '<p>Ошибка загрузки файла!</p>';
        } elseif ($_FILES['userfile']['size'] > 1000000) {
          return  '<p>Файл слишком большой</p>';
        } elseif (
            $_FILES['userfile']['type'] == 'image/jpeg'||
            $_FILES['userfile']['type'] == 'image/png' ||
            $_FILES['userfile']['type'] == 'image/gif'
          ) {
              $translitName = translit($_FILES['userfile']['name']);
              if (copy($_FILES['userfile']['tmp_name'], PHOTO.$translitName)) {
                $path = PHOTO_SMALL.$translitName;
                $type = explode('/', $_FILES['userfile']['type'])[1];
                changeImage(250, 170, $_FILES['userfile']['tmp_name'], $path, $type);
                return $translitName;
                  
              }
              else {return '<p>Ошибка загрузки файла!</p>';}
          }
          else {
            return '</p>Не правильный тип файла!</p>';
        }
      }
 }