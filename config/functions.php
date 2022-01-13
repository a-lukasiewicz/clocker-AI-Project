<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: ../login.php");
	die;

}
function check_company($con)
{

	if(isset($_SESSION['company_id']))
	{
		$id_com = $_SESSION['company_id'];
		$query = "select * from companies where company_id = '$id_com' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$company_data = mysqli_fetch_assoc($result);
			return $company_data;
		}
	}
	//redirect to login
	header("Location: ../login.php");
	die;
}



function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}