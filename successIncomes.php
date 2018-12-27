<?php

	session_start();
	
	if(!isset($_SESSION['userLoggedIn']))
	{
		header ('Location: index.php');
		exit();
	}
	
	
	if (!isset($_SESSION['successfulAddIncomes']))
	{
		header('Location: stronaglowna.php');
		exit();
	}
	else
	{
		unset($_SESSION['successfulAddIncomes']);
		
	}
	
	// Delete variables that remember values ​​entered into the form
	if (isset($_SESSION['formAmountIncome'])) unset($_SESSION['formAmountIncome']);
	if (isset($_SESSION['formDateIncome'])) unset($_SESSION['formDateIncome']);
	if (isset($_SESSION['formCategoryIncome'])) unset($_SESSION['formCategoryIncome']);
	if (isset($_SESSION['formCommentIncome'])) unset($_SESSION['formCommentIncome']);
	
	// Delete registration errors
	if (isset($_SESSION['errorAmountIncome'])) unset($_SESSION['errorAmountIncome']);
	if (isset($_SESSION['errorDateIncome'])) unset($_SESSION['errorDateIncome']);
	if (isset($_SESSION['errorCategoryIncome'])) unset($_SESSION['errorCategoryIncome']);
	if (isset($_SESSION['errorCommentIncome'])) unset($_SESSION['errorCommentIncome']);
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
	<article class="articleFourElements">
		<header>
			<div class="jumbotron">
				<div class="container text-center">
					<h2><span class="colorIcon"><i class="icon-money"></i></span>
					Aplikacja do prowadzenia budżetu domowego!</h2>   				
				</div>
			</div>
		</header>
	
		
		<nav class="navbar navbar-default navbarProperties">
			<div class="container text-center">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
				</div>
				
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="stronaglowna.php">Strona główna</a></li>
						<li class="active"><a href="dodajprzychod.php">Dodaj przychód</a></li>
						<li><a href="dodajwydatek.php">Dodaj wydatek</a></li>
						<li><a href="przegladajbilans.php">Przeglądaj bilans</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ustawienia <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Zmień dane</a></li>
									<li><a href="#">Zmień kategorie</a></li>
									<li><a href="#">Usuń ostatnie wpisy</a></li>
								</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Wyloguj się</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		
		<main>
			<div class="container"> 
					<div class="row text-center">
						<div class="col-md-12 space"></div>
					</div>
			
					<div class="row text-center ">
						<div class="col-md-4 col-md-offset-4 bg6">
							 Przychód został zapisany!
							<br /><br />
	
							<a href="dodajprzychod.php" class="btnSetting" role="button"> Dodaj kolejny przychód!</a>
							<br />	
							 
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