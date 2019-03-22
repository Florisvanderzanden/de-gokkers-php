<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header('location: index.php');
    exit;
}

if ( $_POST['type'] === 'login' ) {

    //zet ingevulde gegevens in makkelijjke variable
    $email = $_POST['email'];
    $password = $_POST['password'];

    $msg = "";

    $sql = "SELECT * FROM gebruikers WHERE email = '$email' AND password = '$password'";
    $query = $db->query($sql);
    $gebruiker = $query->fetch();


    if ( $gebruiker['email'] == $email && $gebruiker['password'] == $password ){
        //een $_SESSION['id'] vullen met de id van de persoon die probeert in te loggen
        //gebruiker doorsturen naar de admin pagina
    }

    //Als email en password niet in de database voorkomen, word teruggestuurd
    if ( $gebruiker['email'] != $email && $gebruiker['password'] != $password ){
        $msg = "Email en/of wachtwoord is niet in orde";
        header("Location: login.php?msg=$msg");
    }

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





