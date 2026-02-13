<?php 
    // Create Cookie:
    setcookie('name', 'Jeremias Springfield', time()+60);
    // Delete Cookie:
    //setcookie('name', 'Jeremias Springfield', time()-60);
?>
<?php 
    $title       = '29- Cookies';
    $description = 'Mechanism for storing data in the remote browser.';

    include 'template/header.php';

    echo "<section>";
?>

<div class="msg">
    <small> Show Cookies: Go to console/storage/cookies</small>
    <br>
    <?php if (isset($_COOKIE['name'])): ?>
        <p> 
            <strong>name:</strong>
            <?php echo $_COOKIE['name'] ?> 
        </p>
    <?php else: ?>
        <p>
            Welcome Guest!
        </p>
    <?php endif ?>
</div>

<?php include 'template/footer.php' ?>