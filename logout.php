<?php

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}
if(isset($_SESSION['company_id']))
{
	unset($_SESSION['company_id']);

}

header("Location: login.php");
die;