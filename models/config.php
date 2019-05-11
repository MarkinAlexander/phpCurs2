<? 
if(session_id() == '') {
  session_start();
}
define ("AUTH_FNC_PATH", MODELS_PATH."auth/");
define ("PAGE_PATH", DOCROOT."html/pages/");
define ("TEMPLATE_PATH", DOCROOT."html/templates/");
define ("CTRL_PATH", DOCROOT."controllers/");

define ("ADMIN", 80);
define ("MANAGER", 50);
define ("CMANAGER", 40);
define ("USER", 10);
define ("GUEST", 0);

define ("SOLT", 'hljkfadshjkladsf');
define ("PHOTO", DOCROOT."img/full/");
define ("PHOTO_SMALL", DOCROOT."img/min/");
define("SERVERURL", 'http://'.$_SERVER['HTTP_HOST'].'/');


