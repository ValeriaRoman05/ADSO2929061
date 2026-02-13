<?php 
$title       = '14- Instanceof';
$description = "Operator to check if an object is an instance of a class.";

include_once 'template/header.php';

echo "<section>";

class Bike {
    protected $brand;
    protected $price;
    protected $refer;
    protected $type;

    public function __construct($brand, $price, $refer) {
        $this->brand = $brand;
        $this->price = $price;
        $this->refer = $refer;
    }

    public function setBike($type) {
        if ($type instanceof Road)   $this->type = 'Road';
        if ($type instanceof Mtb)    $this->type = 'Mtb';
        if ($type instanceof Enduro) $this->type = 'Enduro';
    }

    public function getInfoBike() {
        return "<li>
                    Brand: {$this->brand} | 
                    Price: $ {$this->price} <br>
                    Refer: $ {$this->refer} |
                    Type:  {$this->type}
                </li>";
    }
}

class Road extends Bike { }
class Mtb extends Bike { }
class Enduro extends Bike { }

$bk = new Road('Specialized', 4000, 'Carmak');
$bk->setBike($bk);
echo $bk->getInfoBike();

$bk = new Mtb('Trek', 3200,'Fuel');
$bk->setBike($bk);
echo $bk->getInfoBike();

$bk = new Enduro('SantaCruz', 5200,'MegaTower');
$bk->setBike($bk);
echo $bk->getInfoBike();

include_once 'template/footer.php';