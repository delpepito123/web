<?php

if(isset($_POST["reset-request-submit"])){
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32); 

    $url = "www.delpepitoshop.com/forgottenpwd/create-new-password.php?selector=".$selector."&validator=".bin2hex($token); // lien envoyé au mail

    $expirer = date("U") + 1800;

    require 'dbh.inc.php'; // link la connection à la db

    $userEmail = $_POST["email"];
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?"; // = ? pour ne pas mettre de data dans le sql
    $stmt = mysqli_stmt_init($connection);
    // si la connection échoue retourne une erreur pour pas crash le site
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There's an error1 !";
        exit(); // break sors de la condition
    }
    else{ // si la connection réussie
        mysqli_stmt_bind_param($stmt,"s",$userEmail); // s pour string data type
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    // si la connection échoue retourne une erreur pour pas crash le site
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There's an error2 !";
        exit();                                        // break sors de la condition
    }
    else{    
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);                                         // si la connection réussie
        mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selecteur,$hashedToken,$expirer); // s pour string data type
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    // envoyer le mail

    $to = $userEmail;

    $subject = "Reset your password for delpepitoshop";
    $message = "<p>We recieved a password reset request.The link to reset your password is
     below if you did not make this request, you can ignore this email</p>";
    $message .= "<p>Here is your password reset link :  </br>";
    $message .= '<a href= "' .$url.'">'.$url.'</a></p>';
    
    $headers = "From : delpepitoshop <usedelpepitoshop@gmail.com> \r\n"; // \r \n = new line in php
    $headers .= "Reply-To : usedelpepitoshop@gmail.com \r\n";
    $headers .= "Content-type: text/html \r\n";
    
    mail($to,$subject,$message,$headers);
    header("Location: ../resetpassword.php?reset=success");









}
else{
    header("Location: ../index.php"); // reviens à la page index.php si les instructions sont invalides
}