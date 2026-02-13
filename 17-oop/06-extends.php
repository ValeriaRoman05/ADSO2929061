<?php
$title = '06 - Extends';
$description = 'Keyword for a class to inherit properties and methods from another.';

include_once 'template/header.php';
echo '<section>';

class operation {
    protected $num1;
    protected $num2;

    public function __construct($num1, $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }
}

class Addition extends Operation{
    public function showResult(){
        $result=$this->num1+$this->num2;
        return  "<ul><li>{$this->num1} + {$this->num2}= {$result}</li></ul>";
    }
}
class Substraction extends Operation{
    public function showResult(){
        $result=$this->num1-$this->num2;
        return  "<ul><li>{$this->num1} - {$this->num2}= {$result}</li></ul>";
    }
}
class Product extends Operation{
    public function showResult(){
        $result=$this->num1*$this->num2;
        return  "<ul><li>{$this->num1} * {$this->num2}= {$result}</li></ul>";
    }
}
class Division extends Operation{
    public function showResult(){
        $result=$this->num1/$this->num2;
        return  "<ul><li>{$this->num1} / {$this->num2}= {$result}</li></ul>";
    }
}
class Pow extends Operation{
    public function showResult(){
        $result=$this->num1**$this->num2;
        return  "<ul><li>{$this->num1} ** {$this->num2}= {$result}</li></ul>";
    }
}

$op1=new Addition(16,32);
echo $op1->showResult();

$op1=new Substraction(512,256);
echo $op1->showResult();

$op1=new Product(16,8);
echo $op1->showResult();

$op1=new Division(2048,512);
echo $op1->showResult();

$op1=new Pow(8,3);
echo $op1->showResult();

include_once 'template/footer.php';