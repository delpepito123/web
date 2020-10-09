<?php
    require "header.php";
?>

    <main>
        <div class = "wrapper-main">
            <section class = "section-default">
                <?php
                    if(isset($_SESSION['userId'])){
                        echo '<p class = "login-status"> Vous êtes connecté !</p>';
                    }
                    else{
                        echo '<p class = "login-status"> Vous êtes déconnecté !</p>';
                    }
                ?>
                
            </section>
        </div> 
    </main>

<?php
    require "footer.php";
?>