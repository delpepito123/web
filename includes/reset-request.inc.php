<?php
require '../phpmailer/PHPMailerAutoload.php';


if(isset($_POST["reset-request-submit"])){
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32); 

    $url = "https://localhost/login/create-new-password.php?selector=".$selector."&validator=".bin2hex($token); // lien envoyé au mail

    $expirer = date("U") + 3600;

    require 'dbh.inc.php'; // link la connection à la db

    $userEmail = $_POST["email"];
    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?"; // = ? pour ne pas mettre de data dans le sql
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

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    // si la connection échoue retourne une erreur pour pas crash le site
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There's an error2 !";
        exit();                                        // break sors de la condition
    }
    else{    
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);                                         // si la connection réussie
        mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashedToken,$expirer); // s pour string data type
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    // envoyer le mail

    $to = $userEmail;

    
    
    //mail($to,$subject,$message,$headers);
    header("Location: ../resetpassword.php?reset=success");

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 4;                               // Enable verbose debug output
    
    $mail->isSMTP();                                   // Set mailer to use SMTP
    
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'usedelpepitoshop@gmail.com';                 // SMTP username
    $mail->Password = 'delpepito123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    
    $mail->setFrom('usedelpepitoshop@gmail.com', 'delpepito shop');
    $mail->addAddress("$userEmail");     // Add a recipient // Name is optional
   
    

    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Reset your password for delpepito shop';
    $mail->Body    = '<p> We recieved a password reset. The link to reset your password is below. 
                    If you did not make this request, please ignore this email</p>';
    $mail->Body .= '<p>Here is your password reset link : </p>';
    $mail->Body .= '<a href="'.$url.'">'.$url.'</a></p>';

    $mail->headers = "From: delpepitoshop <usedelpepitoshop@gmail.com>\r\n";
    $mail->headers .= "Reply-To:usedelpepitoshop@gmail.com\r\n";
    $mail->headers .= "Content-type: text/html\r\n"; // \r\n retour à la ligne

    $mail->AltBody = 'This is the body in plain text for non-HTML mai lclients';
    
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'delpepito shop Error: ' . $mail->ErrorInfo;
    } 
    


}
else{
    header("Location: ../index.php"); // reviens à la page index.php si les instructions sont invalides
}