<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
			
			mysqli_query($con, $query);
			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
    <link rel="stylesheet" href="styles/signup.css">
</head>
<body>
    <div id="box">
      <form method="post" id="login">
        <h1 id="title">Sign Up</h1>
        <input id="text" type="text" name="user_name" placeholder="Username" />
        <input id="text" type="password" name="password" placeholder="Password" />
		<input id="button" type="submit" value="Signup">
		<a href="login.php"></a> 
      </form>
    </div>
  </body>
</body>
</html>