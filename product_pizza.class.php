<? include_once "product.class.php";

//Создаем новый класс для описания пиццы у которой новое свойтво диаметр
class Pizza extends Product{
	private $diameter;
	function __construct($id, $title, $img_name, $price, $desct, $weight, $diameter){
		parent::__construct($id, $title, $img_name, $price, $desct, $weight);
		$this->diameter =  $diameter;
	}
	//Создаем новый метод для генерации кода с диаметром пиццы
	function getDiameterContent(){
		return $this->getProperty("Диаметр пиццы", $this->diameter." сантиметров");
	}
	//переопределяем генерацию кода для свойств продукта
	function getPropertiesContent(){
		//вызываем сначала родительский методот
		$result = parent::getPropertiesContent();
		//и к нему добавляем наш метод для отрисовки диаметра пиццы
		return $result.$this->getDiameterContent();
	}
}


$sushi =  new Product(1, "Филадельфия", "img1.jpeg", 300, "Вкусные роллы с сыром и чем то там", 180);	
$pizza =  new Pizza(2, "Цезарь", "img2.jpeg", 600, "Пицца с курицей, сыром пармезан, и светлым соусом", 680, 30);

$sushi->drawProduct();	
$pizza->drawProduct();	

/*5. Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

Что он выведет на каждом шаге? Почему?
Немного изменим п.5:

при первом вызове $a1->foo(); проверит есть ли переменная x и если не задана то задаст 0
и дальше будет вывод от 1 до 4 так как переменная статичная и класс только один хоть и два экземпляра

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();


6. Объясните результаты в этом случае.

в данном случае мы имеем два класса со статичной переменной x и при вызове экземляра от А присвоится 0 и выведется 1, затем вывод экземляра В и так же присвоится 0 и выведется 1
дальше опять экземляр А и вывод цифры 2 и тоже самое с экземляром B и вывод 1122
7. *Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 

Что он выведет на каждом шаге? Почему?
упорно не вижу разницу с шестым примером, всё тоже самое выведет 1122*/
