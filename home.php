
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
						<li class="active"><a href="home.php">Strona główna</a></li>
						<li><a href="addIncome.php">Dodaj przychód</a></li>
						<li><a href="addExpense.php">Dodaj wydatek</a></li>
						<li><a href="viewBalance.php">Przeglądaj bilans</a></li>
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
					<div class="row text-justify ">
						<div class="col-md-8 col-md-offset-2 bg3">
							<article>
					
								<h3 class="articleHeader">Budżet domowy</h3>
								<p>Dzięki prowadzeniu budżetu domowego wiemy, ile wydajemy pieniędzy na poszczególne rzeczy: rachunki, jedzenie, podróże, przyjemności. Możemy dowiedzieć się ile z wydanych pieniędzy były przeznaczone na rzeczy, które są nam nie potrzebne. Gdy mamy pełną kontrolę nad wydatkami, łatwiej jest zaoszczędzić pieniądze na wyznaczony cel np. na nowy samochód czy wakacje. Można pomyśleć o odkładaniu pieniędzy na emeryturę lub "czarną godzinę". Gdy brakuje pieniędzy wiemy o jaką podwyżkę poprosić, ile trzeba zarobić w dodatkowej pracy, aby nie mieć długów.</p>

								<h3 class="articleHeader">Jak działa aplikacja?</h3>
								<p>Za pomocą zakładek menu głównego dodajemy przychody i wydatki (Dodaj przychód, Dodaj wydatek - wypełniamy formularz, przypisujemy kategorie). Używając zakładki Przeglądaj bilans możemy analizować nasze wydatki i przychody w danym okresie dla danych kategorii. Jest możliwość zmiany wpisów oraz personalizacji kategorii przychodów i wydatków.</p>
						
								<h3 class="articleHeader">O autorze</h3>
								<p>Mam na imię Monika. Jestem uczestniczką szkolenia Przyszły Programista.</p>
						</article>		
						
						</div>
							
						<div class="col-md-2"></div>
					</div>
					
					<div class="row text-center ">
						<div class="col-md-4 col-md-offset-4">
							<img class="img-responsive img-rounded" src="img/coins.jpg" alt="coins">
								
						</div>
						<div class="col-md-4"></div>
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