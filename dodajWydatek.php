<?php

	session_start();
	
	if(!isset($_SESSION['userLoggedIn']))
	{
		header ('Location: index.php');
		exit();
	}
	
	if(isset($_POST['amount']))
	{
		//Successful validation
		$allGood = true;
		
		//Validate amount
		$amount = $_POST['amount'];
		$amount = htmlentities($amount,ENT_QUOTES, "UTF-8");
		
		//Is the variable a number?
		if(is_numeric($amount))
		{
			$amount = round($amount,2);
		}
		else
		{
			$allGood = false;
			$_SESSION['errorAmountExpense']="Kwota musi być liczbą. Format:1234.45";
		}
		
		//if the number format is appropriate
		if($amount >= 1000000000)
		{
			$allGood = false;
			$_SESSION['errorAmountExpense']="Kwota musi być liczbą mniejszą od 1 000 000 000.";
		}
		
		//validate date
		$date = $_POST['date'];
		$date = htmlentities($date,ENT_QUOTES, "UTF-8");
		
		if($date == NULL)
		{
			$allGood = false;
			$_SESSION['errorDateExpense'] = "Wybierz datę dla wydatku.";
		}
		
		$currentDate = date('Y-m-d');
		
		if($date > $currentDate)
		{
			$allGood = false;
			$_SESSION['errorDateExpense'] = "Data musi być aktualna lub wcześniejsza.";	
		}
		
		
		//if paymentmethod  are selected
		if(isset($_POST['paymentMethod'])) 
		{
			$paymentMethod = $_POST['paymentMethod'];
			$_SESSION['formPaymentMethod'] = $paymentMethod;
		}
		else
		{
			$allGood = false;
			$_SESSION['errorPaymentMethod'] = "Wybierz kategorię dla płatności.";
		}
		
		//if categories expense are selected
		if(isset($_POST['categoryOfExpense'])) 
		{
			$category = $_POST['categoryOfExpense'];
			$_SESSION['formCategoryExpense'] = $category;
		}
		else
		{
			$allGood = false;
			$_SESSION['errorCategoryExpense'] = "Wybierz kategorię dla wydatku.";
		}
		
		//Validate comment
		$comment = $_POST['comment'];
		$comment = htmlentities($comment,ENT_QUOTES, "UTF-8");
		
		if((strlen($comment) > 100))
		{
			$allGood = false;
			$_SESSION['errorCommentExpense'] = "Komentarz może mieć maksymalnie 100 znaków.";
		}
		
		//Remember entered data
		$_SESSION['formAmountExpense'] = $amount;
		$_SESSION['formDateExpense'] = $date;
		$_SESSION['formCommentExpense'] = $comment;
		
		//Connect database
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$userId = $_SESSION['id'];
				//All Good
				if ($allGood==true)
				{
					$sql="INSERT INTO expenses VALUES (NULL, '$userId',(SELECT id FROM expenses_category_assigned_to_users WHERE user_id ='$userId' AND name='$category'),(SELECT id FROM payment_methods_assigned_to_users WHERE user_id ='$userId' AND name='$paymentMethod'),'$amount','$date','$comment')";
					//Adding a user to the database
					if ($connection->query($sql))
					{
						$_SESSION['successfulAddExpense'] = true;
					    header('Location:successExpense.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
				}
			}
			$connection->close();
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Dodaj wydatek</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Dodaj wydatek. Aplikacja do prowadzenie budżetu osobistego." />
	<meta name="keywords" content="budżet, osobisty, domowy" />
	<meta name="author" content="Monika Burek">
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link rel="stylesheet" href="css/fontello.css" type="text/css"/>
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
						<li><a href="dodajprzychod.php">Dodaj przychód</a></li>
						<li class="active"><a href="dodajwydatek.php">Dodaj wydatek</a></li>
						<li><a href="#">Przeglądaj bilans</a></li>
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
								<form method = "post">
									
									<div class="row">
										<div class="form-group">
											<label class="control-label col-sm-1"  for="amount">Kwota:</label>
											<div class="col-sm-6">
												<input type="amount" class="form-control" value="<?php 
											if (isset($_SESSION['formAmountExpense']))
											{
												echo $_SESSION['formAmountExpense'];
												unset($_SESSION['formAmountExpense']);
											}
										?>" name="amount">
												<?php
											if (isset($_SESSION['errorAmountExpense']))
											{
												echo '<div class="error">'.$_SESSION['errorAmountExpense'].'</div>';
												unset($_SESSION['errorAmountExpense']);
											}
											?> 
												
											</div>
											<div class="col-sm-5"></div>
										</div>
									</div>
	  
									<div class="row">
										<div class="form-group">
											<label class="control-label col-sm-1" for="dateExpense">Data:</label>
											<div class="col-sm-6">
												<input type="date" name="date" value="<?php 
											if (isset($_SESSION['formDateExpense']))
											{
												echo $_SESSION['formDateExpense'];
												unset($_SESSION['formDateExpense']);
											}
										?>" class="form-control" placeholder="dd-mm-rrrr" onfocus="this.placeholder=''" onblur="this.placeholder='dd-mm-rrrr">
												<?php
											if (isset($_SESSION['errorDateExpense']))
											{
												echo '<div class="error">'.$_SESSION['errorDateExpense'].'</div>';
												unset($_SESSION['errorDateExpense']);
											}
											?>
											</div>
											<div class="col-sm-5"></div>	  
										</div>
									</div>
	 
									<div class="row ">
										<span class="titleForm">Sposób płatności:</span>
									</div>
<?php

	//Connect database
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
		
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);

		if ($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		
		else
		{
			//Check number of income categories
			$userId = $_SESSION['id'];
			
			$resultOfQuery=$connection->query("SELECT name FROM payment_methods_assigned_to_users WHERE user_id ='$userId'");
			
			if(!$resultOfQuery) throw new Exception($connection->error);
				
			$howNames=$resultOfQuery->num_rows;
			
			
			if($howNames>0)
			{
				while ($row = $resultOfQuery->fetch_assoc())
				{
					echo '<div class="row ">';
					echo '<div class="col-sm-4 col-sm-offset-1">';
					echo '<label class="radio-inline">';
					echo '<input type="radio" name="paymentMethod" value="'.$row['name'];
					
					if(isset($_SESSION['formPaymentMethod']))
					{
						if($row['name'] == $_SESSION['formPaymentMethod']) 
						{
							echo '"checked ="checked"';
						}
					}
					
					echo '">'.$row['name'].'</label>';
					echo '</div>';
					echo '<div class="col-sm-5"></div>';
					echo '</div>';	
			    }
				
				$resultOfQuery->free_result();
			}
			else
			{
				
			}
		}
		$connection->close();
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br />Informacja developerska: '.$e;
	}
?>		
									
									<div class="row rowExpense">
										<span class="titleForm">Kategoria płatności:</span>
									</div>
									<?php

	//Connect database
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
		
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		
		else
		{
			//Check number of paymentMethod
			$userId = $_SESSION['id'];
			
			$resultOfQuery=$connection->query("SELECT name FROM expenses_category_assigned_to_users WHERE user_id ='$userId'");
			
			if(!$resultOfQuery) throw new Exception($connection->error);
				
			$howNames=$resultOfQuery->num_rows;
			
			if($howNames>0)
			{
				while ($row = $resultOfQuery->fetch_assoc())
				{
					echo '<div class="row ">';
					echo '<div class="col-sm-4 col-sm-offset-1">';
					echo '<label class="radio-inline">';
					echo '<input type="radio" name="categoryOfExpense" value="'.$row['name'];
					
					if(isset($_SESSION['formCategoryExpense']))
					{
						if($row['name'] == $_SESSION['formCategoryExpense']) 
						{
							echo '"checked ="checked"';
						}
					}
					
					echo '">'.$row['name'].'</label>';
					echo '</div>';
					echo '<div class="col-sm-5"></div>';
					echo '</div>';	
			    }
				$resultOfQuery->free_result();
			}
			else
			{
				
			}
		}
		$connection->close();
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br />Informacja developerska: '.$e;
	}
?>		
									
									<div class="form-group rowExpense">
										<label for="comment">Komentarz (opcjonalnie):</label>
										<textarea class="form-control" rows="3" name = "comment" ><?php 
											if (isset($_SESSION['formCommentExpense']))
											{
												echo $_SESSION['formCommentExpense'];
												unset($_SESSION['formCommentExpense']);
											}
										?></textarea>
									<?php
	if (isset($_SESSION['errorCommentExpense']))
	{
		echo '<div class="error">'.$_SESSION['errorCommentExpense'].'</div>';
		unset($_SESSION['errorCommentExpense']);
	}
?>	
									</div>
									
									
									
									<div class="row ">
									
										<div class="col-sm-5 col-sm-offset-2">
											<button type="submit" class="btnSetting">Dodaj</button>
										</div>
										<div class="col-sm-5">
											<button type="submit" class="btnSetting">Anuluj</button>
										</div>
									
									</div>
								</form>	
								
							</article>		
						
						</div>
							
						<div class="col-md-2"></div>
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