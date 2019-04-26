<?
  CONST PHOTO = '.'. DIRECTORY_SEPARATOR .'img_max'. DIRECTORY_SEPARATOR ;
  CONST PHOTO_SMALL = '.'. DIRECTORY_SEPARATOR .'img_min'. DIRECTORY_SEPARATOR ;
  $message = '';
  $server = "localhost";
  $login = "root";
  $pass = "";
  $db = "images";

  $connect = mysqli_connect($server,$login,$pass,$db);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
