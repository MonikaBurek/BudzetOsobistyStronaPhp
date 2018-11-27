// Przeglądaj bilans: napis

function displayText()
{
	
	var differenceInBalanceString;
	var differenceInBalance;
	var text;
	
	differenceInBalanceString = document.getElementById("differenceNumber").innerHTML;
	differenceInBalance = Number(differenceInBalanceString);
	
	
	if (differenceInBalance >= 0)
	{
		text = differenceInBalance + 'Gratulacje.Świetnie zarządzasz finasami!';
	}
	else (differenceInBalance < 0)
	{
		text = differenceInBalance + 'Uważaj, wpadasz w długi!';
	}
	
	document.getElementById("differenceText").innerHTML = text;
}
