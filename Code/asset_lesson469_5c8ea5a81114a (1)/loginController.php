<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header('location: index.php');
    exit;
}

if ( $_POST['type'] === 'login' ) {
    var_dump($_POST);
    /*
     * Hier komen we als we de login form data versturen.
     * things to do:
     * 1. Checken of gebruikersnaam EN email in de database bestaat met de ingevoerde data
     * 2. Indien ja, een $_SESSION['id'] vullen met de id van de persoon die probeert in te loggen.
     * 3. gebruiker doorsturen naar de admin pagina
     *
     * 3. Indien nee, gebruiker terugsturen naar de login pagina met de melding dat gebruikersnaam en/of
     * wachtwoord niet in orde is.
     *
     */
    exit;
}

if ($_POST['type'] === 'register') {
    /*
     * Hier komen we als we de register form data versturen
     * things to do:
     *
     *
     *
     * 3. Dan gebruiker inserten in de database, zodat deze kan gaan inloggen.
     * 4. Gebruiker doorsturen naar de nieuwe inlog pagina.
     *
     * 5. Indien ja, gebruiker terugsturen naar register form met de melding dat gebruikersnaam en/of wachtworod niet op
     * orde is.
     *
     *
     */

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $msg = "";

    $sql = "SELECT * FROM gebruikers WHERE email = '$email'";
    $query = $db->query($sql);
    $gebruiker = $query->fetch();

    if( $gebruiker['email'] == $email ){
        $msg = "Dit E-mailadres is al in gebruik!";
    }

    if( $msg == "" && $password == ""){
        $msg = "Wachtwoord verplicht";
    }

    if($msg == "" && $password != $password_confirm){
        $msg = "Wachtwoord moet hetzelfde zijn";
    }

    if( $msg != ""){
        header( "Location: register.php?msg=$msg");
    }

    exit;
}





