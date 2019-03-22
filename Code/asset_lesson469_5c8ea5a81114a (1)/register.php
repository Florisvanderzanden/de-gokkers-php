<?php
require 'header.php';
?>

<form class="register-form" action="loginController.php" method="post">
    <input type="hidden" name="type" value="register">
    <div class="form-group">
        <label for="email">email</label>
        <input type="email" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="password_confirm">Please confirm your password</label>
        <input type="password" name="password_confirm" id="password_confirm">
    </div>

    <?php
        if ( isset( $_GET['msg'] )) {
            echo "<p>{$_GET['msg']}</p>";
        }
    ?>

    <input class="submit" type="submit" value="Register">
</form>

<?php require 'footer.php'; ?>

