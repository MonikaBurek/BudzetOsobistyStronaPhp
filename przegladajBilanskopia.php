<?php

	session_start();
	
	if(!isset($_SESSION['userLoggedIn']))
	{
		header ('Location: index.php');
		exit();
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

<body onload="createPieChart()">
	<article class="articleFiveElements">
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
		
		<div class="row rowWithMarginBottom">
			<div class="col-md-6 col-md-offset-3">
				<form class="form-inline" method = "post">
					<div class="form-group">
						<label for="periodOfTime">Wybierz okres czasu:</label>
						<select class="form-control" name="periodOfTime">
							<option value="currentMonth">Bieżący miesiąc</option>
							<option value="previousMonth">Poprzedni miesiąc</option>
							<option value="currentYear">Bieżący rok</option>
							<option value="selectedPeriod">Wybrany okres</option>
						</select>
					</div>	
				</form>
				
				<?php
				if(isset($_POST['periodOfTime']))
				echo $_POST['periodOfTime'];
				if(isset($_POST['periodOfTime'])&& $_POST['periodOfTime'] == "selectedPeriod")
				{
					echo '<form method = "post">';
							echo '<div class="row">';
										echo '<div class="form-group">';
										echo '<label class="control-label col-sm-1" for="date">Data:</label>';
										echo '<div class="col-sm-6">';
											echo '<input type="date" name="date" class="form-control" placeholder="dd-mm-rrrr">';
										echo '</div>';
										echo '<div class="col-sm-5"></div>';  
										echo '</div>';
							echo '</div>';
					echo '</form>';
				}
				?>
			</div>
		</div>	
		
		<main>
			<div class="container"> 
					<div class="row text-center">
						<div class="col-md-4 col-md-offset-2 bg3">
							<article>
									<h4>Zestawienie przychodów dla poszczególnych kategorii w okresie ...</h4>
									
									 <div class="table-responsive text-left">          
										 <div class="table-responsive">          
										  <table class="table table-striped table-bordered table-condensed">
											<thead>
											  <tr>
												<th>Nazwa kategorii</th>
												<th>Suma przychodów [zł]</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>Wynagrodzenie</td>
												<td>1258.45</td>
											  </tr>
											  <tr>
												<td>Odsetki bankowe</td>
												<td>6.57</td>
											  </tr>
											  <tr>
												<td>Sprzedaż na Allegro</td>
												<td>84.45</td>
											  </tr>
											</tbody>
										  </table>
										 </div>
									</div>							
							</article>
						</div>
						
						<div class="col-md-1"></div>
						
						<div class="col-md-4 bg3">
							<article>
									<h4>Zestawienie wydatków dla poszczególnych kategorii w okresie ...</h4>
									
									 <div class="table-responsive text-left">          
										 <div class="table-responsive">          
										  <table class="table table-striped table-bordered table-condensed">
											<thead>
											  <tr>
												<th>Nazwa kategorii</th>
												<th>Suma wydatków [zł]</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>Mieszkanie</td>
												<td>658.58</td>
											  </tr>
											  <tr>
												<td>Transport</td>
												<td>10.57</td>
											  </tr>
											  <tr>
												<td>Telekomunikacja</td>
												<td>50.90</td>
											  </tr>
											  <tr>
												<td>Opieka zdrowotna</td>
												<td>56.12</td>
											  </tr>
											   <tr>
												<td>Oszczędności</td>
												<td>70.00</td>
											  </tr>
											</tbody>
										  </table>
										 </div>
									</div>							
							</article>
						</div>	
						<div class="col-md-1"></div>
					</div>

					<div class="row emptyRow"></div>
					
					<div class="row ">
						<div class="col-md-6  col-sm-12 col-md-offset-3 ">
							
							<div id="chartContainer"></div>
							
						</div>
						<div class="col-md-3"></div>
					</div>
					
					<div class="row emptyRow"></div>
					
					<div class="row ">
						<div class="col-md-6 col-md-offset-3 bg5">
							<div class="col-md-3 col-md-offset-1">Suma przychodów:</div>
							<div class="col-md-3">
							
								<div class="well well-sm wellResult">2000 zł</div>
							</div>	
							<div class="col-md-5"></div>	
						</div>
						<div class="col-md-3"></div>
					</div>
					
					<div class="row ">
						<div class="col-md-6 col-md-offset-3 bg5 ">
							<div class="col-md-3 col-md-offset-1">Suma wydatków:</div>
							<div class="col-md-3">
							
								<div class="well well-sm wellResult">1500 zł</div>
							</div>	
							<div class="col-md-5"></div>	
						</div>
						<div class="col-md-3"></div>
					</div>
					
					<div class="row ">
						<div class="col-md-6 col-md-offset-3 bg5 ">
							<div class="col-md-3 col-md-offset-1">Różnica:</div>
							<div class="col-md-3">
							
								<div class="well well-sm wellFinalResult">
									<div id="differenceNumber">500</div>
								</div>
							</div>
							
							<div class="col-md-5 ">
								<div id="differenceText"> Wyświetla tekst Ok lub nie OK</div>
								<script src="js/functionDisplayText.js"></script>
							</div>	
						</div>
						<div class="col-md-3"></div>
					</div>
					
					<div class="row emptyRow"></div>
			</div>
		</main>
		
		
		<footer class="container-fluid text-center">
			
			Wszystkie prawa zastrzeżone &copy; 2018  Dziękuję za wizytę!
		</footer>
		
	</article>	
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		 
	
</body>
</html>