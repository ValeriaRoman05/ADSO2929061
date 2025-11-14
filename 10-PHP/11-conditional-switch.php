<?php 
    $title       = '11- Conditional switch';
    $description = 'Select code block based on value';

    include 'template/header.php';
    echo "<section>";

    $monthNumber = date('m');

    switch ($monthNumber) {
        case 1:
            echo "<h4>It's January!</h4>";
            break;
        case 2:
            echo "<h4>It's February!</h4>";
            break;
        case 3:
            echo "<h4>It's March!</h4>";
            break;
        case 4:
            echo "<h4>It's April!</h4>";
            break;
        case 5:
            echo "<h4>It's May!</h4>";
            break;
        case 6:
            echo "<h4>It's June!</h4>";
            break;
        case 7:
            echo "<h4>It's July!</h4>";
            break;
        case 8:
            echo "<h4>It's August!</h4>";
            break;
        case 9:
            echo "<h4>It's September!</h4>";
            break;
        case 10:
            echo "<h4>It's October!</h4>";
            break;
        case 11:
            echo "<h4>It's November!</h4>";
            break;
        case 12:
            echo "<h4>It's December!</h4>";
            break;
        default:
            echo "<h4>Invalid month number.</h4>";
            break;
    }
?>

<?php  include 'template/footer.php'; ?>