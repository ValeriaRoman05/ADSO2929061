<?php 
$title       = '12- Method Final';
$description = "A method that cannot be overwritten by any child class.";

include_once 'template/header.php';

echo "<section>";

class Fruit {
    private $name;
    private $color;

    public function __construct($name, $color) {
        $this->name = $name;
        $this->color = $color;
    }

    public final function showInfoFruit() {
        return "<li> 
                    <b>Fruit Name: </b> $this->name  <br>
                    <b>Fruit Color:</b> $this->color
                </li>";
    }
}
class Orange extends Fruit {
    # Error: Cannot override final method
    # public function showInfoFruit() {}
}
$fr = new Fruit('Pinapple', 'Yellow');
echo $fr->showInfoFruit();

$fr = new Fruit('Apple', 'Green');
echo $fr->showInfoFruit();

$fr = new Fruit('Blueberry', 'Dark Purple');
echo $fr->showInfoFruit();


include_once 'template/footer.php';