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

    $sql = "SELECT * FROM gebruikers WHERE email = '$email'";
    $query = $db->query($sql);
    $gebruiker = $query->fetch();

    if (password_verify($password, $gebruiker['password'])){
        header("Location: download.php");
    }
    else{
        $msg = "Email en/of wachtwoord is niet in orde";
        header("Location: login.php?msg=$msg");
    }

    exit;
}

if ($_POST['type'] === 'register') {

    //zet ingevulde gegevens in makkelijjke variable
    $emailspace = $_POST['email'];
    $email = str_replace( ' ', '', $emailspace);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $accept = $_POST['accept'];

    $msg = "";

    //kijkt of email geldig is
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    }
    else{
        $msg = "Email adres is ongeldig";
    }

    $sql = "SELECT * FROM gebruikers WHERE email = '$email'";
    $query = $db->query($sql);
    $gebruiker = $query->fetch();

    //Vergelijkt opgegeven email met email uit database
    if( $msg == "" && $gebruiker['email'] == $email ){
        $msg = "Dit E-mailadres is al in gebruik!";
    }

    //kijkt of password is ingevuld
    if( $msg == "" && $password == ""){
        $msg = "Wachtwoord verplicht";
    }

    //kijkt of wachtwoord lang genoeg is
    if( $msg == "" && strlen($password) <= 7 ){
        $msg = "Wachtwoord moet minmaal 7 karakters lang zijn";
    }

    //Kijkt of wachtwoord een hoofdletter heeft
    if ($msg == "" && !preg_match("#[A-Z]+#", $password)) {
        $msg = "Wachtwoord moet een hoofdletter bevatten";
    }

    //kijkt of wachtwoord een cijfer heeft
    if ($msg == "" && !preg_match("#[0-9]+#", $password)) {
        $msg = "Wachtwoord moet een cijfer bevatten";
    }

    //kijkt of password en password confirm hetzelfde zijn
    if($msg == "" && $password != $password_confirm){
        $msg = "Wachtwoord moet hetzelfde zijn";
    }

    //controleert of algemene voorwaarden zijn geaccepteerd
    if($msg == "" && $accept == false ){
        $msg = "Accepteer eerst de algemene voorwaarden";
    }

    //stuurt je wanneer nodig terug naar het register form
    if( $msg != ""){
        header( "Location: register.php?msg=$msg");
    }

    //zet ingevulde gegevens in database wanneer alles goed is
    if( $msg == "" ){

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO gebruikers (email, password) VALUES (:email, :password)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':email' => $email,
            ':password' => $hashed_password
        ]);

        $msg = "Succesvol geregistreerd";
        header( "Location: login.php?msg=$msg");
    }

    exit;
}