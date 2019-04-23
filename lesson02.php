<?
/*
1. Создать структуру классов ведения товарной номенклатуры.
а) Есть абстрактный товар.
б) Есть цифровой товар, штучный физический товар и товар на вес.
в) У каждого есть метод подсчета финальной стоимости.
г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. 
	У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. 
	У всех формируется в конечном итоге доход с продаж.
	д) Что можно вынести в абстрактный класс, наследование?
*/

abstract class Goods{
	//доход я так понимаю должен высчитываться исходя из того сколько товар идет в закупке и вычитываться разница
	abstract public function getIncome();
	//расчет конечной цены
	abstract public function getFinalPrice();
	//вывод результата
	abstract public function drawInfo();
}
//штучные товары
class PriceGoods extends Goods{
	//название товара
	protected $name;
	//Цена продажи
	protected $sellingPrice;
	//Цена закупки
	protected $purchasePrice;
	//количество
	protected $count;
	public function __construct($name, $pieceSellingPrice, $piecePurchasePrice, $count = 1){
		$this->sellingPrice = $pieceSellingPrice;
		$this->purchasePrice = $piecePurchasePrice;
		$this->count = $count;
		$this->name = $name;
	}
	public function getIncome(){
		return ($this->sellingPrice - $this->purchasePrice)*$this->count;
	}
	public function getFinalPrice(){
		return $this->count * $this->sellingPrice;
	}
	public function drawInfo(){
		$finalPrice = $this->getFinalPrice();
		$income = $this->getIncome();
		echo "Вы купите у нас $this->count шт. товара $this->name за $finalPrice рублей, мы заработаем на этой сделке $income!<br>";
	}
}
//Цифровые товары, цену берем от штучной и делим пополам, может я не так условие понял, буду рад если объясните
class DigitalGoods extends PriceGoods{
		public function __construct($name, $pieceSellingPrice, $piecePurchasePrice, $count = 1){
		$this->sellingPrice = $pieceSellingPrice * 0.5;
		$this->purchasePrice = $piecePurchasePrice * 0.5;
		$this->count = $count;
		$this->name =  $name;
	}
}
//товар весовой
class WeightGoods extends PriceGoods{
	//для единиц измерения
	private $unit;
	public function __construct($name, $unit, $pieceSellingPrice, $piecePurchasePrice, $count = 1){
		$this->unit = $unit;
		parent::__construct($name, $pieceSellingPrice, $piecePurchasePrice, $count);
	}
	public function drawInfo(){
		$finalPrice = $this->getFinalPrice();
		$income = $this->getIncome();
		echo "Вы купите у нас $this->count $this->unit товара $this->name за $finalPrice рублей, мы заработаем на этой сделке $income!<br>";
	}
}

//допустим 20 физических книг
$book1 = new PriceGoods('Основы PHP', 1000, 700, 20);
//электронная книга, цены такие же как на физическую а методы пересчитают сами, опять же если правильно понял задание
$book2 = new DigitalGoods('Основы PHP', 1000, 700);
//весовые товары с разными единицами веса
$banans = new WeightGoods('Бананы','килограмм', 100, 89, 3);
$apples = new WeightGoods('Яблоки','килограмм', 150, 75, 1.8);
$rice = new WeightGoods('Рис "Японский особый производсво Краснодар"','фунт', 380, 120, 3);

$book1->drawInfo();
$book2->drawInfo();

$banans->drawInfo();
$apples->drawInfo();
$rice->drawInfo();