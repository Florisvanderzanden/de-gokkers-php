<?php require 'header.php'; ?>

<?php
if( isset($_SESSION['id']) ){
    echo "<p>Boeie Ruurd</p>";
}
?>

    <div class="download">
        <div class="download-left">
            <h2>Downloaden</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, ex. Eveniet reiciendis repudiandae ratione, quidem possimus distinctio hic enim id? Nostrum quis mollitia beatae odio, id quisquam praesentium. Saepe, quis.</p>
        </div>
        <div class="download-right">
            <form class="download-form" action="loginController.php" method="post">
                <a href="degokkers.php">Download</a>
            </form>
        </div>
    </div>

<?php require 'footer.php'; ?>