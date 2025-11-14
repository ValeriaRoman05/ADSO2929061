<?php 
    $title       = '22- Forms Get';
    $description = 'Retrieve data from a GET request.';

    include 'template/header.php';

    echo "<section>";
?>
<form action="" method="GET">
    <div class="row">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="row">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>
    <div class="row">
        <input type="submit" value="Send Form">
        <input type="reset" value="Clear Form">
    </div>
</form>
<?php if ($_GET): ?>
    <?php if (!empty($_GET['name']) && !empty($_GET['email'])): ?>
    <div class="msg">
        <strong>Full Name:</strong> <?php echo $_GET['name']; ?>
        <br>
        <strong>Email:</strong> <?php echo $_GET['email']; ?>
    </div>
    <?php else: ?>
        <div class="error">
            <small>Please fill text fields</small>
        </div>
    <?php endif ?>
<?php endif ?>

<?php include 'template/footer.php' ?>