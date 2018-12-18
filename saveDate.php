<?php

	session_start();
	
	if(!isset($_SESSION['userLoggedIn']))
	{
		header ('Location: index.php');
		exit();
	}
	
	if(isset($_POST['periodOfTime']))
	{
		$allGood = true;
		$periodOfTime = $_POST['periodOfTime'];
		$_SESSION['formPeriodOfTime'] = $periodOfTime;
	}
	
	if(isset($_POST['startDate'])) 
	{
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$now = date('Y-m-d');
		$startDate = htmlentities($startDate,ENT_QUOTES, "UTF-8");
		$endDate = htmlentities($endDate,ENT_QUOTES, "UTF-8");
		$allGood = true;
		
		if($startDate == NULL)
		{
			$allGood = false;
			$_SESSION['errorStartDate'] = "Wybierz datę dla początku okresu.";
		}
				
		if($endDate == NULL)
		{
			$allGood = false;
			$_SESSION['errorEndDate'] = "Wybierz datę dla końca wykresu.";
		}				
					
		if($startDate > $now)
		{
			$allGood = false;
			$_SESSION['errorStartDate'] = "Data początku okresu nie może być większa od dzisiejszej daty.";
		}
					
		if($endDate > $now)
		{
			$allGood = false;
			$_SESSION['errorEndDate'] = "Data końca okresu nie może być większa od dzisiejszej daty.";
		}
			
		if($endDate!=NULL && $startDate!=NULL)
		{
			if($endDate < $startDate)
			{
				$allGood = false;
				$_SESSION['errorEndDate'] = "Data końca okresu nie może być mniejsza od daty początku okresu.";
			}
		}
		
		$_SESSION['formStartDate'] = $startDate;
		$_SESSION['formEndDate'] = $endDate;
		
		$_SESSION['periodStartDate'] = $startDate  ;
		$_SESSION['periodEndDate'] = $endDate;
		
	
		if ((isset($_SESSION['periodStartDate'])) && isset($_SESSION['periodEndDate']) && $allGood == true)
		{
			header ('Location: bilans.php');
		}
		
		
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
						
							
				
				<?php
				if(isset($_SESSION['formPeriodOfTime'])&& $_SESSION['formPeriodOfTime'] == "selectedPeriod")
				{
		
				echo '<div class="col-md-5 col-md-offset-2 bg3">';
					echo '<form method = "POST" >';
							echo '<div class="row">';
								echo '<h3 class="articleHeader">Wybierz okres czasu dla bilansu.</h3>';
							echo '</div>';
							echo '<div class="row rowExpense">';
										echo '<div class="form-group">';
										echo '<label class="control-label col-sm-4 text-right" for="startDate">Początek okresu:</label>';
										echo '<div class="col-sm-6">';
											echo '<input type="date" name="startDate" value="';
											if (isset($_SESSION['formStartDate']))
											{
												echo $_SESSION['formStartDate'];
												unset($_SESSION['formStartDate']);
											}
											echo '"class="form-control" placeholder="dd-mm-rrrr">';
											
											if (isset($_SESSION['errorStartDate']))
											{
												echo '<div class="error">'.$_SESSION['errorStartDate'].'</div>';
												unset($_SESSION['errorStartDate']);
											}
											
										echo '</div>';
										echo '<div class="col-sm-2"></div>';  
										echo '</div>';
							echo '</div>';
							echo '<div class="row">';
								echo '<div class="form-group">';
									echo '<label class="control-label col-sm-4 text-right" for="endDate">Koniec okresu:</label>';
									echo '<div class="col-sm-6">';
										echo '<input type="date" name="endDate" value="';
											if (isset($_SESSION['formEndDate']))
											{
												echo $_SESSION['formEndDate'];
												unset($_SESSION['formEndDate']);
											}
											echo '" class="form-control" placeholder="dd-mm-rrrr">';
										if (isset($_SESSION['errorEndDate']))
											{
												echo '<div class="error">'.$_SESSION['errorEndDate'].'</div>';
												unset($_SESSION['errorEndDate']);
											}
									echo '</div>';
								echo '<div class="col-sm-2"></div>';  
								echo '</div>';
							echo '</div>';
							echo '<div class="row ">';
								echo '<div class="col-sm-7 col-sm-offset-3">';
									echo '<button type="submit" class="btnSetting">Wyświetl bilans</button>';
								echo '</div>';
								echo '<div class="col-sm-2"></div>';
							echo '</div>';
							
					echo '</form>';
				echo '</div>';
				
				}
				else if ($_SESSION['formPeriodOfTime'] == "currentMonth" || $_SESSION['formPeriodOfTime'] == "previousMonth" || $_SESSION['formPeriodOfTime'] == "currentYear")
				{ 
					header ('Location: bilans.php');
				}
				
				?>
							
							
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