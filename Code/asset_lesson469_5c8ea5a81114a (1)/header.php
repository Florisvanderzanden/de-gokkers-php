<?php
    require 'config.php';
?>

<!-- Even heel easy html code, omdat de focus nu op het inlogsysteem ligt en niet op fancy looks :)  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>De Gokkers PHP</title>
    <link rel="stylesheet" href="website.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <h1>De Gokkers PHP</h1>
        <nav>
            <a href="index.php">Download</a>
            <a href="login.php">Login</a>
            <a href="register.php">Registreer</a>
        <?php
        /*
         * Hier checken we of we al ooit eens een 'id' key hebben opgeslagen in de
         * $_SESSION variabele. de ENIGE plek waar we dit doen is als we onszelf inloggen
         * en onze gegevens kloppen. Kijk maar in de logincontroller.php
         *
         * Als we dus al een id in onze session hebben (dus onze klant is al ingelogd) willen we niet dat onze
         * klanten zich nogmaals kunnen registreren of inloggen...
         *
         */
        /* if ( isset($_SESSION['id']) ) {
         *   echo "You are currently logged in. Want to <a href='register.php'>logout?</a>";
         * } else {
         *   echo "<a href='login.php'>Login</a> &nbsp; or &nbsp; <a href='register.php'> register </a>";
         * }*/
        ?>
        </nav>
    </div>
</header>
<main>
    <div class="container">