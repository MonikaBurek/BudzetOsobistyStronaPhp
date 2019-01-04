<?php
	
	session_start();
	
	if ((!isset($_POST['name'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

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
			$name = $_POST['name'];
			$password = $_POST['password'];
			
			$name = htmlentities($name, ENT_QUOTES, "UTF-8");
		
			if ($resultOfQuery = $connection->query(
			sprintf("SELECT * FROM users WHERE username='%s'",
			mysqli_real_escape_string($connection,$name))))
			{
				$howUsers = $resultOfQuery->num_rows;
				if($howUsers>0)
				{
					$row = $resultOfQuery->fetch_assoc();
					
					if(password_verify($password,$row['password']))
					{
						$_SESSION['userLoggedIn'] = true;
						$_SESSION['id'] = $row['id'];
						
						unset($_SESSION['errorLogin']);
						$resultOfQuery->free_result();
						header('Location: stronaGlowna.php');
					}
					else
					{
						$_SESSION['errorLogin'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
						header('Location: index.php');
					}
				}
				else
				{
					$_SESSION['errorLogin'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
			$connection->close();	
		}
	}
	
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
		echo '<br />Informacja developerska: '.$e;
	}
?>