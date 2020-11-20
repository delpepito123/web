<?php
    require "header.php";
?>

    <main>
    <link rel = "stylesheet" href ="css/style.css" type="text/css">
        <div class = "wrapper-main">
            <section class = "section-default">
                <?php
                    if(isset($_SESSION['userId'])){
                        echo '<p class = "login-status1"> Vous êtes connecté !</p>';
                    }
                ?>
                
            </section>
        </div> 
    </main>

<?php
    require "footer.php";
?>