<? 
//Создаем класс для описания продукта
class Product{
	private $title;
	private $id;
	private $img_name;
	private $price;
	private $desct;
	private $weight;
	
	//конструктор класса
	function __construct($id, $title, $img_name, $price, $desct, $weight){
		$this->id = $id;
		$this->title = $title;
		$this->img_name = $img_name;
		$this->price = $price;
		$this->desct = $desct;
		$this->weight =  $weight;
	}
	
	function getTitleContent(){
		return "<h2>$this->title</h2>"; 
	}
	function getImgContent(){
		return "<div class=\"product_img\"><img src=\"/img/$this->img_name\" alt=\"Фото товара $this->title\"></div>";
	}
	
	function getDesctContent(){
		return "<p class=\"product_desct\">$this->desct</p>";
	}
	//так как свойст может быть много изначально заложил метод который принимает аргументы и возвращает свойство
	function getProperty($string, $arg){
		return "<p class=\"product_properties\"><strong>$string:</strong> $arg</p>";
	}
	function getWeightContent(){
		return $this->getProperty("Вес", $this->weight." грамм");
	}
	function getPropertiesContent(){
		return $this->getWeightContent();
	}
	function getPriceContent(){
		return "<p class=\"product_price\"><strong>Цена:</strong> $this->price рублей</p>";
	}
	function getBtnsContent(){
		return "<div class=\"product_btn\"><div class=\"btn btn_buy\" data-product_id=\"$this->id\">Купить</div></div>";
	}
	function getProductContent(){
		$result = '';
		$result .= $this->getTitleContent();
		$result .= $this->getImgContent();
		$result .= $this->getDesctContent(); 		
		$result .= $this->getPropertiesContent(); 		
		$result .= $this->getPriceContent(); 		
		$result .= $this->getBtnsContent();
		return $result;
	}
	function drawProduct(){
		echo $this->getProductContent();
	}
}