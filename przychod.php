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
		
		//Is the variable a number?
		if(is_float($amount)==false)
		{
			if(is_int($amount)==false)
			{
				$allGood = false;
				$_SESSION['errorAmount']="Kwota musi być liczbą.";
			}
		}	
		
		//if the number format is appropriate
		if($amount >= 1000000000)
		{
			$allGood = false;
			$_SESSION['errorAmount']="Kwota musi być liczbą mniejszą od 1 000 000 000.";
		}
		
		//Round the number to two decimal places
		echo round($amount,2);
		
	}
?>