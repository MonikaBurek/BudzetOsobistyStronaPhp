<?php

	session_start();
	
	if (!isset($_SESSION['successfulRegistration']))
	{
		header('Location: logowanie.php');
		exit();
	}
	else
	{
		unset($_SESSION['successfulRegistration']);
	}
	
	// Delete variables that remember values ​​entered into the form
	if (isset($_SESSION['formName'])) unset($_SESSION['formName']);
	if (isset($_SESSION['formEmail'])) unset($_SESSION['formEmail']);
	if (isset($_SESSION['formPassword'])) unset($_SESSION['formPassword']);
	
	// Delete registration errors
	if (isset($_SESSION['errorName'])) unset($_SESSION['errorName']);
	if (isset($_SESSION['errorEmail'])) unset($_SESSION['errorEmail']);
	if (isset($_SESSION['errorPassword'])) unset($_SESSION['errorPassword']);
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Strona główna</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Aplikacja do prowadzenie budżetu osobistego." />
	<meta name="keywords" content="budżet, osobisty, domowy" />
	<meta name="author" content="Monika Burek">
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	
</head>

<body>
	<article>
		<header>
			<div class="jumbotron">
				<div class="container text-center">
					<h2><span class="colorIcon"><i class="icon-money"></i></span>
					Aplikacja do prowadzenia budżetu domowego!</h2>   				
				</div>
			</div>
		</header>	
		
		
		<main>
			<div class="container"> 
					<div class="row text-center">
						<div class="col-md-12 space"></div>
					</div>
			
					<div class="row text-center ">
						<div class="col-md-4 col-md-offset-4 bg2">
							Dziękuję za rejestrację na stronie! Możesz już zalogować się na swoje konto!<br /><br />
	
							<a href="logowanie.php" class="btnSetting" role="button"> Zaloguj się na swoje konto!</a>
							<br /><br />	
								
						</div>
						<div class="col-md-4"></div>
					</div>
					
					<div class="row text-center">
						<div class="col-md-12 space"></div>
					</div>
					<div class="row text-center">
						<div class="col-md-12 space"></div>
					</div>
			</div>
		</main>
		
		<footer class="container-fluid text-center">
			
			Wszystkie prawa zastrzeżone &copy; 2018  Dziękuję za wizytę!
		</footer>
	</article>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</body>
</html>