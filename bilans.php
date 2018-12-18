<?php

	session_start();
	
	if(!isset($_SESSION['userLoggedIn']))
	{
		header ('Location: index.php');
		exit();
	}
	
	if(isset($_SESSION['formPeriodOfTime']))
	{
		$allGood = true;
		$periodOfTime=$_SESSION['formPeriodOfTime'];
		echo 'nazwa: '.$_SESSION['formPeriodOfTime'];
		$now = date('Y-m-d');
		
		if($periodOfTime == "currentMonth")
		{
			$startDate = date('Y-m-d',strtotime("first day of this month"));
			$endDate = date('Y-m-d',strtotime("now"));
		}
		else if($periodOfTime == "previousMonth")
		{
			$startDate = date('Y-m-d',strtotime("first day of previous month"));
			$endDate = date('Y-m-d',strtotime("last day of previous month"));
		}
		else if($periodOfTime == "currentYear")
		{
			$startDate = date('Y-m-d',strtotime("1 January this year"));
			$endDate = date('Y-m-d',strtotime("now"));
		}
		else if($periodOfTime == "selectedPeriod")
		{
	
			
			
		}
		echo ' początek: '.$startDate;
		echo ' koniec: '.$endDate;
	}
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Przeglądaj bilans</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Przeglądaj bilans. Aplikacja do prowadzenie budżetu osobistego." />
	<meta name="keywords" content="budżet, osobisty, domowy" />
	<meta name="author" content="Monika Burek">
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link rel="stylesheet" href="css/fontello.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	
	<script src="js/pieChart.js" type="text/javascript"></script>
	
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
						<li><a href="dodajprzychod.php">Dodaj przychód</a></li>
						<li><a href="dodajwydatek.php">Dodaj wydatek</a></li>
						<li class="active"><a href="przegladajbilans.php">Przeglądaj bilans</a></li>
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
					<div class="row text-justify">
						<div class="row rowWithMarginBottom">
							
						</div>	
							
							
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