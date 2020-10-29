<?php
require "header.php";
?>

<main>
    <div class="">
        <section class="">
            <h1>Mot de passe oublié ?</h1>
            <p>Un e-mail de confirmation sera envoyé avec les instructions requises pour récupérer votre mot de passe</p>
            <form action="includes/reset-request.c.php" method="post">
                <input type = "text" name="email" placeholder="Entrez votre adresse mail..">
                <button type="submit" name="reset-request-submit"> Recevez un nouveau mot de passe via votre adresse mail </button>
            </form>
        </section>
    </div>  
</main>


