<?php

	session_start();
	
	if( isset($_POST['email']))
	{
		//Successful validation
		$allGood = true;
		
		//Validate your login
		$name = $_POST['name'];
		
		//Check length login
		if ((strlen($name)<3) || (strlen($name)>20))
		{
			$allGood = false;
			$_SESSION['errorName']="Login musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($name)==false)
		{
			$allGood = false;
			$_SESSION['errorName']="Login może składać się tylko z liter(bez polskich liter) i cyfr!";
		}
		
		$name = strtolower($name);  // Format: name
		
		//Validate email
		$email = $_POST['email'];
		$secureEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
		
		if((filter_var($secureEmail,FILTER_VALIDATE_EMAIL)==false) || 
		($secureEmail != $email))
		{
			$allGood = false;
			$_SESSION['errorEmail']="Niepoprawny adres e-mail";
		}
		
		//Validate password
		$password = $_POST['password'];
		
		//Check password length
		if((strlen($password) < 8) || (strlen($password) > 20))
		{
			$allGood = false;
			$_SESSION['errorPassword']="Hasło musi posiadaćod 8 do 20 znaków!";
		}
		
		//Password hashing
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		
		//validate re-catcha
		$secretKey = "6Lc8028UAAAAAHLJLMyx45qS2yCNvsWhHl3ens9f";
		
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
		
		$answer = json_decode($check);
		
		if ($answer->success==false)
		{
			$allGood = false;
			$_SESSION['errorBot']="Potwierdź, że nie jesteś botem!";
		}	

		//Remember entered data
		$_SESSION['formName']=$name;
		$_SESSION['formEmail']=$email;
		$_SESSION['formPassword']=$password;

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
				//whether login already exists
				$resultOfQuery=$connection->query("SELECT id FROM users WHERE username='$name'");
				
				if(!$resultOfQuery) throw new Exception($connection->error);
				
				$howNicks=$resultOfQuery->num_rows;
				if($howNicks>0)
				{
					$allGood = false;
					$_SESSION['errorName']="Istnieje już konto dla podanego loginu.";
				}
				
				//whether mail already exists
				$resultOfQuery=$connection->query("SELECT id FROM users WHERE email='$email'");
				
				if(!$resultOfQuery) throw new Exception($connection->error);
				
				$howEmails=$resultOfQuery->num_rows;
				if($howEmails>0)
				{
					$allGood = false;
					$_SESSION['errorEmail']="Istnieje już konto dla podanego adresu mailowego.";
				}
				
				
				
				//All Good
				if ($allGood==true)
				{
					//Adding a user to the database
					if ($connection->query("INSERT INTO users VALUES 
					(NULL, '$name','$passwordHash','$email')"))
					{
						if($connection->query("INSERT INTO expenses_category_assigned_to_users(user_id, name) SELECT u.id AS user_id, d.name FROM users AS u CROSS JOIN expenses_category_default AS d WHERE u.email='$email'"))
						{
							$_SESSION['successfulRegistration'] = true;
							header('Location: witamy.php');
						}
						else
						{
							throw new Exception($connection->error);
						}	
					}
					else
					{
						throw new Exception($connection->error);
					}
					
				}
				
				$connection->close();
				
			}
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
	<title>Rejestracja</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Rejestracja w aplikacji do prowadzenie budżetu osobistego." />
	<meta name="keywords" content="budżet, osobisty, domowy" />
	<meta name="author" content="Monika Burek">
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	<style>
	.error
	{
		font-size : 13px;
		color: red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	</style>
	
</head>

<body>
	<article class="articleThreeElements">
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
					<div class="row text-center ">
						<div class="col-md-12 space"></div>
					</div>
			
					<div class="row text-center ">
						<div class="col-md-4 col-md-offset-4 bg1">
							<ul class="nav nav-pills nav-justified">
								<li class="active"><a href="rejestracja.php"><h3>Rejestracja</h3>(Nie mam konta)</a></li>	
								<li><a href="index.php"><h3>Logowanie</h3>(Mam konto)</a></li>		
							</ul>
						</div>
						<div class="col-md-4"></div>
					</div>
					
					<div class="row text-center ">
						<div class="col-md-4 col-md-offset-4 bg2">
							<form class="form-horizontal" method ="post">
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="name">Login:</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php 
											if (isset($_SESSION['formName']))
											{
												echo $_SESSION['formName'];
												unset($_SESSION['formName']);
											}
										?>" name="name" placeholder="Podaj login">
									
										
										<?php
											if (isset($_SESSION['errorName']))
											{
												echo '<div class="error">'.$_SESSION['errorName'].'</div>';
												unset($_SESSION['errorName']);
											}
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3" for="email">Email:</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" value=
										"<?php 
											if (isset($_SESSION['formEmail']))
											{
												echo $_SESSION['formEmail'];
												unset($_SESSION['formEmail']);
											}
										?>" name="email" placeholder="Podaj email">
								        
										
										<?php
											if (isset($_SESSION['errorEmail']))
											{
												echo '<div class="error">'.$_SESSION['errorEmail'].'</div>';
												unset($_SESSION['errorEmail']);
											}
										?>
									</div>
								</div>

		
								<div class="form-group">
									<label class="control-label col-sm-3" for="password">Hasło:</label>
									<div class="col-sm-9"> 
										<input type="password" class="form-control" value="<?php 
											if (isset($_SESSION['formPassword']))
											{
												echo $_SESSION['formPassword'];
												unset($_SESSION['formPassword']);
											}
										?>" name="password" placeholder="Podaj hasło">
										
										 
										<?php
											if (isset($_SESSION['errorPassword']))
											{
												echo '<div class="error">'.$_SESSION['errorPassword'].'</div>';
												unset($_SESSION['errorPassword']);
											}
										?>
									</div>
								</div>
								
								<div class="col-sm-offset-1 col-sm-11">
									<div class="g-recaptcha" data-sitekey="6Lc8028UAAAAAFQCzQEqlfLdnLK5fwfNXgwzBvsB">
									</div>
									<?php
										if (isset($_SESSION['errorBot']))
										{
											echo '<div class="error">'.$_SESSION['errorBot'].'</div>';
											unset($_SESSION['errorBot']);
										}
									?>	
								</div>
	  
								<div class="form-group"> 
									<div class="col-sm-offset-1 col-sm-11">
										<button type="submit" class="btnSetting">Zarejestruj się!</button>
									</div>
								</div>
							</form>	
								
						</div>
						<div class="col-md-4"></div>
					</div>
					
			</div>
		</main>
		
		<footer class="container-fluid text-center">
			Wszystkie prawa zastrzeżone &copy; 2018  Dziękuję za wizytę!
		</footer>
		
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</article>
</body>
</html>