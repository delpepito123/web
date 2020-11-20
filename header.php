<?php
	session_start();
	//require_once('..phpmailer/PHPMailerAutoload');
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">
    <meta name = "description" content = "Ceci est un exemple">
    <meta name = viewport content = "width = device-width, initial-scale = 1">
    <title></title>
    <link rel = "stylesheet" href ="css/style.css">
	
    </head>
    <body>

        <header>
            <nav>
                <a href = "#">
				
					<div class="header">
						<img style="margin-left:30px;" src = "img/Laplata_Improvisation2.png" alt = "logo">
					
					
							<div class="greeen">
							
							
							
									<div>
										<?php
											 if(isset($_SESSION['userId'])){
												echo ' <form action ="includes/logout.inc.php" method = "post">
												<button class="buttonlogin" type = "submit" name = "logout-submit"> Logout </button>
												</form>';
											}
											else{
												echo '<form action ="includes/login.inc.php" method = "post">
												<input class="button"type = "text" name ="mailuid" placeholder = "Username/E-mail...">    
												<input class="button" type = "password" name ="pwd" placeholder = "Password...">
												<button class="buttonlogin" type = "submit" name = "login-submit"> Login </button> 

					 
												 
												
											
											<button class="buttonlogin"> <a style="color:white;" href ="signup.php"> Signup </a>  </button> </form> ' 
											;
											}


										?>
									

									</div>		

									
							</div>
							
							
							
					</div>
					
						
				</a>
					<div class="subheader">
							<div class="info" style="margin-left:150px;"> 	<a href = "index.php"> Home </a></div>
							<div class="info"> 								<a href = "#"> Portfolio </a> </div>
							<div class="info"> 								<a href = "#"> About me </a> </div>
							<div class="info"> 								<a href = "#"> Contact </a></div>

					</div>
					

            </nav>
			
				
				
				
				
				
				</div>
        </header>








    </body>




</html>