<?php
    require "header.php";
?>

    <main>
        <div class = "wrapper-main">
            <section class = "section-default">
                <h1> Signup </h1>
                <?php 
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields"){
                            echo '<p class = "signuperror">Les champs sont vides </p>';
                        }
                        else if ($_GET['error'] == "invaliduidmail"){
                            echo '<p class="signuperror">Nom utilisateur / e-mail invalide ! </p>';

                        }
                        else if ($_GET['error'] == "invaliduid"){
                            echo '<p class="signuperror">Nom utilisateur invalide ! </p>';

                        }
                        else if ($_GET['error'] == "invalidmail"){
                            echo '<p class="signuperror">e-mail invalide ! </p>';

                        }
                        else if ($_GET['error'] == "passwordcheck"){
                            echo '<p class="signuperror">Mot de passe incorrect!</p>';

                        }
                        else if ($_GET['error'] == "usertaken"){
                            echo '<p class="signuperror">Pseudo déjà utilisé</p>';

                        }

                    }

                    else if(!empty($_GET['signup']) &&  $_GET['signup'] == "success"){ 
                        echo '<p class="signup"> Connected</p>';

                    }
                  
                ?>
                <div class = "jesus">
                
                <form action = "includes/signup.inc.php" method = "post">
                    <input class = "button" type = "text" name = "uid"  placeholder = "Username">
                    <input class = "button" type = "text" name = "mail" placeholder = "E-mail">
                    <input class = "button" type = "password" name = "pwd"  placeholder = "Password">
                    <input class = "button" type = "password" name = "pwd-repeat" placeholder = "Repeat Password">
                    <button class = "buttonlogin"  type = "submit" name = "signup-submit"> Signup </button>
                </form>
                <?php
                    if(isset($_GET["newpwd"])){
                        if($_GET["newpwd"] == "passwordupdated"){
                            echo '<p class="signupsuccess"> Your password has been reset !</p>';
                        }
                    } 
                ?>
                <a href = "resetpassword.php">Forgot password ?</a> 
        </section>


                    

                </div> 
    </main>

