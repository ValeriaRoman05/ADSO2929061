<?php 
$title       = '19- Trait';
$description = "A mechanism for code reuse in single inheritance languages.";

include_once 'template/header.php';

echo "<section>";

trait Hello {
    public function showHello($name) {
        echo "<ul><li> <b>Welcome:</b> ".$name."</li></ul>";
    }
}
trait Adso {
    public function showAdso($code) {
        echo "<ul><li> <b>Program:</b> ".$code."</li></ul>";
    }
}
class Department {
    use Hello, Adso;
    public function showDepartment($dep) {
        echo "<ul><li> <b>Department:</b> ".$dep."</li></ul>";
    }
}

$hl = new Department;
$hl->showHello('Jeremias Springfield');
$hl->showAdso(2929061);
$hl->showDepartment('Caldas');

include_once 'template/footer.php';