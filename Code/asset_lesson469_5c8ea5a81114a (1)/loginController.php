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

    $email = $_POST['email'];
    $password = $_POST['password'];

    

    exit;
}

if ($_POST['type'] === 'register') {

    //zet ingevulde gegevens in makkelijjke variable
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $msg = "";

    $sql = "SELECT * FROM gebruikers WHERE email = '$email'";
    $query = $db->query($sql);
    $gebruiker = $query->fetch();

    //Vergelijkt opgegeven email met email uit database
    if( $gebruiker['email'] == $email ){
        $msg = "Dit E-mailadres is al in gebruik!";
    }

    //kijkt of password is ingevuld
    if( $msg == "" && $password == ""){
        $msg = "Wachtwoord verplicht";
    }

    //kijkt of password en password confirm hetzelfde zijn
    if($msg == "" && $password != $password_confirm){
        $msg = "Wachtwoord moet hetzelfde zijn";
    }

    //stuurt je wanneer nodig terug naar het register form
    if( $msg != ""){
        header( "Location: register.php?msg=$msg");
    }

    //zet ingevulde gegevens in database wanneer alles goed is
    if( $msg == "" ){

        $sql = "INSERT INTO gebruikers (email, password) VALUES (:email, :password)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':email' => $email,
            ':password' => $password
        ]);

        $msg = "Succesvol geregistreerd";
        header( "Location: login.php?msg=$msg");
    }

    exit;
}





