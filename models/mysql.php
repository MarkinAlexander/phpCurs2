<? 
$server = "localhost";
$login = "root";
$pass = "";
$db = "markincart";

$connect = mysqli_connect($server,$login,$pass,$db);
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}