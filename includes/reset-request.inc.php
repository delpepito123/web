<?php

if(isset($_POST["reset-request-submit"])){
    
    $selecteur = bin2hex(random_bytes(8));
    $token = random_bytes(32); 

    $url = "www.delpepitoshop.com/forgottenpwd/create-new-password.php?selector=".$selecteur."&validator=".bin2hex($token); // lien envoyé au mail

    $expirer = date("U") + 1800;

    require 'dbh.inc.php'; // link la connection à la db

    $userEmail = $_POST["email"];
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?"; // = ? pour ne pas mettre de data dans le sql
    $stmt = mysqli_stmt_init($connection);
    // si la connection échoue retourne une erreur pour pas crash le site
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "Il y a une erreur!";
        exit(); // break sors de la condition
    }
    else{ // si la connection réussie
        mysqli_stmt_bind_param($stmt,"s",$userEmail); // s pour string data type
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelecteur,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    // si la connection échoue retourne une erreur pour pas crash le site
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "Il y a une erreur!";
        exit();                                        // break sors de la condition
    }
    else{    
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);                                         // si la connection réussie
        mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selecteur,$hashedToken,$expirer); // s pour string data type
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close();

    // envoyer le mail

    $to = $userEmail;

    $subject = "Reset le mot de passe pour delpepitoshop.com";
    $message = "<p> Vous avez reçu un mail concernant le reset de votre mot de passe. Le lien pour reset votre mot de passe est en dessous. Si vous n'avez</p>";


}
else{
    header("Location: ../index.php"); // reviens à la page index.php si les instructions sont invalides
}