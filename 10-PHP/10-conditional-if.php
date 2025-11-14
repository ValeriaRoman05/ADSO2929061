<?php 
    $title       = '10- Conditional if';
    $description = 'Executes code if condition is true';

    include 'template/header.php';
    echo "<section>";

    $day = date('D');
?>

<?php if($day == 'Mon'): ?>
    <h4>Today is Monday</h4>
<?php elseif($day == 'Tue'): ?>
    <h4>Today is Tuesday</h4>
<?php elseif($day == 'Wed'): ?>
    <h4>Today is Wednesday</h4>
<?php elseif($day == 'Thu'): ?>
    <h4>Today is Thursday</h4>
<?php elseif($day == 'Fri'): ?>
    <h4>Today is Friday</h4>
<?php else: ?>
    <h4>🥳 Happy Weekend!</h4>
<?php endif ?>

<?php  include 'template/footer.php'; ?>