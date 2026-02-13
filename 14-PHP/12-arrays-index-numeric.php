<?php 
    $title       = '12- Arrays Index Numeric';
    $description = 'Stores multiples values accessed by index';

    include 'template/header.php';
    echo "<section>";

    $fruits = array("🍎", "🍌", "🍊", "🥭");

    echo "My favorite fruit is: " . $fruits[0] . "<br>"; 
    echo "The second fruit in the list is: " . $fruits[1] . "<br>"; 

    $fruits[2] = "🍇";
    echo "The updated third fruit is: " . $fruits[2] . "<br>"; 

    $fruits[] = "🍍";
    echo "The newly added fruit is: " . $fruits[4] . "<br>";

    echo "All fruits in the array: <br>";
    foreach ($fruits as $fruit) {
        echo $fruit . " ";
    }

?>

<?php  include 'template/footer.php'; ?>