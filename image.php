<?
   include_once 'models/config.php';

      $sql = "select img_name from img WHERE id_img =" .(int)$_GET['photo'];
      $sql2 = "UPDATE img SET like_count = like_count + 1 WHERE id_img =".(int)$_GET['photo'];

      $res = mysqli_query($connect,$sql);
     // mysqli_close($connect);
      mysqli_query($connect,$sql2);
     // mysqli_close($connect);
      $data = mysqli_fetch_assoc($res);
      //echo $data['img_name'];
	  $imageName = PHOTO.$data['img_name'];
	// подгружаем и активируем авто-загрузчик Twig-а
	require_once 'Twig/Autoloader.php';
	Twig_Autoloader::register();
	try {
	  // указывае где хранятся шаблоны
	  $loader = new Twig_Loader_Filesystem('templates');
	  
	  // инициализируем Twig
	  $twig = new Twig_Environment($loader);
	  
	  // подгружаем шаблон
	  $template = $twig->loadTemplate('image.tmpl');
	  
	  // передаём в шаблон переменные и значения
	  // выводим сформированное содержание
	  
	  $content = $template->render(array(
		'title' => 'Каталог изображений',
		'imageName' => $imageName
	  ));
	  echo $content;
	  
	} catch (Exception $e) {
	  die ('ERROR: ' . $e->getMessage());
	}
